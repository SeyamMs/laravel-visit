<?php

use Illuminate\Support\Collection;
use SeyamMs\LaravelVisit\Facades\LaravelVisit;
use SeyamMs\LaravelVisit\Tests\TestModels\Page;

beforeEach(function () {
    $this->testPage = Page::first();
    $this->laravelVisit = LaravelVisit::setModel($this->testPage);
});

it('can decide whether to increament or not', function () {
    expect($this->laravelVisit->shouldIncrement())
        ->toBeBool();
});

it('can count visits', function () {
    expect($this->testPage->vzt()->count())
        ->toBeInt();
});

it('has available factors', function () {
    $value = $this->laravelVisit->availableFactors();
    expect($value)
        ->toBeInstanceOf(Collection::class);
    expect($value->count())
        ->toBeGreaterThan(0);
});

it('has default factors', function () {
    $value = $this->laravelVisit->defaultFactors();
    expect($value)
        ->toBeInstanceOf(Collection::class);
    expect($value->count())
        ->toBeGreaterThan(0);
});

it('always has factors', function () {
    $value = $this->laravelVisit->getFactors();
    expect($value)
        ->toBeInstanceOf(Collection::class);
    expect($value->count())
        ->toBeGreaterThan(0);
});
