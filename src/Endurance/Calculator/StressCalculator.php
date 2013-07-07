<?php 

namespace Endurance\Calculator;

class StressCalculator
{
    protected $ltDays;
    protected $stDays;

    protected $ltExp;
    protected $stExp;

    protected $ltsValues;
    protected $stsValues;
    protected $sbValues;

    public function __construct($ltDays = 42, $stDays = 7)
    {
        $this->ltDays = $ltDays;
        $this->stDays = $stDays;

        $this->ltExp = exp(-1 / $this->ltDays);
        $this->stExp = exp(-1 / $this->stDays);
    }

    /**
     * Calculate long-term stress, short-term stress and stress balance scores for each day.
     * 
     * @param  \DateTime $startDate    The start of the date range
     * @param  \DateTime $endDate      The end of the date range
     * @param  array     $stressValues Stress score values for each day. The key of the array should be the date in the format "Ymd".
     */
    public function calculate(\DateTime $startDate, \DateTime $endDate, array $stressValues)
    {
        $this->ltsValues = array();
        $this->stsValues = array();
        $this->sbValues = array();

        $lastLTS = 0;
        $lastSTS = 0;
        $datePeriod = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);
        foreach ($datePeriod as $date) {
            $dateIndex = $date->format('Ymd');

            $stressValue = isset($stressValues[$dateIndex]) ? $stressValues[$dateIndex] : 0;

            $this->ltsValues[$dateIndex] = $lastLTS = ($stressValue * (1 - $this->ltExp)) + ($lastLTS * $this->ltExp);
            $this->stsValues[$dateIndex] = $lastSTS = ($stressValue * (1 - $this->stExp)) + ($lastSTS * $this->stExp);
            $this->sbValues[$dateIndex] = $this->ltsValues[$dateIndex] - $this->stsValues[$dateIndex];
        }
    }

    public function getLTSValues()
    {
        return $this->ltsValues;
    }

    public function getSTSValues()
    {
        return $this->stsValues;
    }

    public function getSBValues()
    {
        return $this->sbValues;
    }
}
