<?php 

namespace Endurance;

abstract class Metric
{
    protected $dependencies;
    protected $options;
    protected $value;

    public function __construct(array $options = array())
    {
        $this->options = $options;
    }

    abstract public function calculate(array $points, HeartRateZones $zones, array $dependencies);

    /**
     * Returns a hash of the class name and options
     * 
     * @return string
     */
    public function getHash()
    {
        return sha1(get_class($this) . '(' . json_encode($this->options, JSON_FORCE_OBJECT) . ')');
    }

    protected function loadDependencies()
    {
        return array();
    }

    public function getDependencies()
    {
        if (!isset($this->dependencies)) {
            $this->dependencies = $this->loadDependencies();
        }

        return $this->dependencies;
    }
}
