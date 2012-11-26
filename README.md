Endurance
=========

Endurance is a PHP library for parsing cycling GPS activities and calculating metrics.

Usage
-----

### Parse TCX files from Garmin devices

```php
<?php

use Endurance\TCXParser;

$parser = new TCXParser();
$activity = $parser->parse('/path/to/activity.tcx');
```

### Calculate useful metrics

```php
<?php

use Endurance\Calculator\HeartRateZoneCalculator;
use Endurance\Calculator\MetricCalculator;
use Endurance\Metric\AverageMovingSpeedMetric;

$zoneCalculator = new HeartRateZoneCalculator();
$zones = $zoneCalculator->calculateZones(182);

$metricCalculator = new MetricCalculator();
$metrics = $metricCalculator->calculate(array(
    'averageMovingSpeed' => new AverageMovingSpeedMetric()
), $activity->getPoints(), $zones);

// Returns an associative array of the calculated metric values
// $metrics = ['averageMovingSpeed' => 26.43]
```

Running the Tests
-----------------

### Setup the vendor directory

As some filesystem adapters use vendor libraries, you should install the vendors:

    $ cd endurance
    $ php composer.phar install --dev

### Launch the test suite

In the root directory:

    $ phpunit

Is it green?
