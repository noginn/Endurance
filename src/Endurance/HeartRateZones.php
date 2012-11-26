<?php 

namespace Endurance;

class HeartRateZones
{
    private $zones = array();

    public function __construct(array $zones)
    {
        $this->setZones($zones);
    }

    public function setZones(array $zones)
    {
        foreach ($zones as $zone) {
            $this->addZone($zone);
        }
    }

    public function addZone(HeartRateZone $zone)
    {
        $this->zones[$zone->getName()] = $zone;
    }

    public function getZone($name)
    {
        if (!isset($this->zones[$name])) {
            throw new \InvalidArgumentException(sprintf('The zone "%s" does not exist', $name));
        }

        return $this->zones[$name];
    }

    public function getZones()
    {
        return $this->zones;
    }

    public function whichZone($heartRate)
    {
        foreach ($this->zones as $zone) {
            if ($zone->inZone($heartRate)) {
                return $zone;
            }
        }

        throw new \RuntimeException(sprintf('The heart rate %d does not fall inside a zone', $heartRate));
    }
}
