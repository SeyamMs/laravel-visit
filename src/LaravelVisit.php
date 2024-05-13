<?php

namespace SeyamMs\LaravelVisit;

use Exception;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Collection;
use SeyamMs\LaravelVisit\Models\Visit;
use Illuminate\Database\Eloquent\Model;

class LaravelVisit
{
    public $model;
    public $visit;
    public $config;
    public $ip_address;
    public $platform;
    public $device;
    public $browser;
    public $language;

    public function __construct()
    {
        $agent = new Agent();
        $this->config = config('visit');
        $this->platform = $agent->platform();
        $this->device = $agent->device();
        $this->browser = $agent->browser();
        $this->language = $agent->languages()[0] ?? null;
        $this->ip_address = request()->ip();
    }

    public function setModel(Model $model): LaravelVisit
    {
        $this->model = $model;
        $this->visit = $this->getVisitRecord();
        return $this;
    }

    public function make(Model $model): LaravelVisit
    {
        return $this->setModel($model);
    }

    public function init(Model $model): LaravelVisit
    {
        return $this->setModel($model);
    }

    public function availableFactors(): Collection
    {
        return collect(['ip_address', 'platform', 'device', 'browser', 'language']);
    }

    public function defaultFactors(): Collection
    {
        return collect(['ip_address', 'platform']);
    }

    public function getFactors(): Collection
    {
        $factors = collect($this->config['factors']);

        if ($factors->isEmpty()) {
            return $this->defaultFactors();
        }

        return $factors->reject(fn ($factor, $key) => $this->availableFactors()->doesntContain($factor));
    }

    public function getSha1(): string
    {
        $factors = $this->getFactors()->mapWithKeys(fn ($factor, $key) => [$factor => $this->{$factor}]);

        return sha1($factors->implode(','));
    }

    public function count(): int
    {
        if (!$this->model) {
            throw new Exception("You must use setModel(), make() or init() first");
        }

        return $this->model->relation()->sum('weight');
    }

    public function getVisitRecord(): Visit
    {
        if (!$this->model) {
            throw new Exception("You must use setModel(), make() or init() first");
        }

        return $this->model->relation()->firstOrCreate([
            'sha1' => $this->getSha1()
        ]);
    }

    public function shouldIncrement(): bool
    {
        $span = $this->config['span'] ?? '1 day';

        if (now()->sub($span) > $this->visit->updated_at) {
            return true;
        }

        return false;
    }

    public function increment(): LaravelVisit
    {
        if ($this->shouldIncrement()) {
            $this->visit->increment('weight');
        }

        return $this;
    }
}
