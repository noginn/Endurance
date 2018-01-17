<?php

namespace Endurance;

class Point
{
    public $elevation;
    public $distance;
    public $heartrate;
    public $latitude;
    public $longitude;
    public $speed;
    public $time;
    public $power;
    public $cadence;

    public function __construct()
    {
        $this->time = new \DateTime();
    }

    public function setElevation($elevation)
    {
        $this->elevation = (int) $elevation;
    }

    public function getElevation()
    {
        return $this->elevation;
    }

    public function setDistance($distance)
    {
        $this->distance = (float) $distance;
    }

    public function getDistance()
    {
        return $this->distance;
    }

    public function setHeartRate($heartrate)
    {
        $this->heartrate = (int) $heartrate;
    }

    public function getHeartRate()
    {
        return $this->heartrate;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = (float) $latitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = (float) $longitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setSpeed($speed)
    {
        $this->speed = (float) $speed;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setPower($power)
    {
        $this->power = (float) $power;
    }

    public function getPower()
    {
        return $this->power;
    }

    public function setCadence($cadence)
    {
        $this->cadence = (float) $cadence;
    }

    public function getCadence()
    {
        return $this->cadence;
    }

    public function setTime(\DateTime $time)
    {
        $this->time = $time;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTimestamp()
    {
        return $this->time->getTimestamp();
    }
}
