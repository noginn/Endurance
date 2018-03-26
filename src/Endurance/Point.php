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
        $this->elevation = (float) $elevation;
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

    public function calculateDistance($previousPoint)
    {
        if ($this->getLatitude() != null &&
            $this->getLongitude() != null &&
            $previousPoint->getLatitude() != null &&
            $previousPoint->getLongitude() != null)
        {
            $R = 6371;

            $latDistance  = ($previousPoint->getLatitude() - $this->getLatitude()) * M_PI / 180;
            $longDistance = ($previousPoint->getLongitude() - $this->getLongitude()) * M_PI / 180;

            $a = sin($latDistance / 2) * sin($latDistance / 2)
                + cos($this->getLatitude() * M_PI / 180) * cos($previousPoint->getLatitude() * M_PI / 180)
                * sin($longDistance / 2) * sin($longDistance / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            $distance = $R * $c * 1000; // in meters

            $this->setDistance($previousPoint->getDistance() + $distance);
        }
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
