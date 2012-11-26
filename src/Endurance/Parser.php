<?php 

namespace Endurance;

use Endurance\Activity;

abstract class Parser
{
    protected $activity;

    abstract public function parse($file);
}
