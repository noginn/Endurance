<?php 

namespace Endurance;

class HeartRateZone
{
    private $name;
    private $longName;
    private $lowerLimit;
    private $upperLimit;

    public function __construct($name, $longName, $lowerLimit, $upperLimit)
    {
        $this->name = $name;
        $this->longName = $longName;
        $this->lowerLimit = $lowerLimit;
        $this->upperLimit = $upperLimit;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getLongName()
    {
        return $this->longName;
    }

    public function getLowerLimit()
    {
        return $this->lowerLimit;
    }

    public function getUpperLimit()
    {
        return $this->upperLimit;
    }

    public function inZone($heartRate)
    {
        return $heartRate >= $this->getLowerLimit() && $heartRate <= $this->getUpperLimit();
    }
}
