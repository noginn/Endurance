<?php 

namespace Endurance\Parser;

class TCXParserTest extends \PHPUnit_Framework_TestCase
{
    public $parser;
    public $activity;
    public $points;

    public function setUp()
    {
        $this->parser = new TCXParser();
        $this->activity = $this->parser->parse(__DIR__ . '/Fixtures/activity.tcx');
        $this->points = $this->activity->getPoints();
    }

    public function testParseReturnsActivityWithAllPoints()
    {
        // There are actually 1111 points in the file but some are ignored as they are incomplete
        $this->assertEquals(1108, count($this->activity->getPoints()));
    }

    public function testParseSetsPointElevation()
    {
        $this->assertEquals(173, $this->points[10]->getElevation());
    }

    public function testParseSetsPointDistance()
    {
        $this->assertEquals(62.540000915527, $this->points[10]->getDistance());
    }

    public function testParseSetsPointHeartRate()
    {
        $this->assertEquals(122, $this->points[10]->getHeartRate());
    }

    public function testParseSetsPointLatitude()
    {
        $this->assertEquals(52.613816997036, $this->points[10]->getLatitude());
    }

    public function testParseSetsPointLongitude()
    {
        $this->assertEquals(-1.1924629379064, $this->points[10]->getLongitude());
    }

    public function testParseSetsPointTime()
    {
        $this->assertEquals('2012-11-09 17:25:01', $this->points[10]->getTime()->format('Y-m-d H:i:s'));
    }

    public function testParseAddsLaps()
    {
        $this->assertEquals(5, count($this->activity->getLaps()));
    }
}
