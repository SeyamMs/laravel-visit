<?php

return [


    // this array sets how precise it is required to detect different users,
    // the values of the corresponding key in this array is evaluated from the incoming request,
    // a collection with key value sets is defined (sorted like they sorted here),
    // sha1 is evaluated for the results of implode method to this collection,
    // same sha1 weight is incremented after defined span has elapsed.
    /**
     * available factors are:
     * ['ip_address', 'platform', 'device', 'browser', 'language']
     * default: ['ip_address', 'platform']
     */
    'factors' => [
        'ip_address',
        'platform',
        // 'device',
        // 'browser',
        // 'language',
    ],


    // this accepts a valid carbon interval. 
    // 1 day, 2 days, 1 week, 2 months ...etc
    // default: 1 day 
    'span' => '1 day',


];
