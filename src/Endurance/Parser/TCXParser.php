<?php

namespace Endurance\Parser;

use Endurance\Activity;
use Endurance\Lap;
use Endurance\Parser;
use Endurance\Point;

class TCXParser extends Parser
{
    public function parse($file)
    {
        if (!is_file($file)) {
            throw new \Exception(sprintf('Unable to read file "%s"', $file));
        }

        $activity = new Activity();

        $xml = simplexml_load_file($file);
        if (!isset($xml->Activities->Activity)) {
            throw new \Exception(sprintf('Unable to find an Activity', $file));
        }

        // Just parse the first activity
        $activityNode = $xml->Activities->Activity[0];
        $activity->setStartTime(new \DateTime((string) $activityNode->Id));
        $activity->setSport((string) $xml->Activities->Activity[0]->attributes()['Sport']);

        $laps = array();
        foreach ($activityNode->Lap as $lapNode) {
            $laps[] = $this->parseLap($activity, $lapNode);
        }

        if (count($laps) > 1) {
            // Only set the laps if there is more than one
            $activity->setLaps($laps);
        }

        return $activity;
    }

    /**
     * Convert speed value from m/s to km/h
     *
     * @param  float $speed The speed in m/s
     * @return float The speed in km/h
     */
    protected function convertSpeed($speed)
    {
        return $speed * 3.6;
    }

    protected function parseLap(Activity $activity, \SimpleXMLElement $lapNode)
    {
        $startIndex = count($activity->getPoints());

        foreach ($lapNode->Track as $trackNode)
        {
            $this->parseTrack($activity, $trackNode);
        }

        $lap = new Lap($startIndex, count($activity->getPoints()) - 1);

        // Sometimes distance is only stored on the laps
        if ($lapNode->DistanceMeters)
        {
            $lap->setDistance((float) $lapNode->DistanceMeters);
        }

        if (isset($lapNode->attributes()['StartTime']))
        {
            $lap->setStartTime(new \DateTime((string) $lapNode->attributes()['StartTime']));
        }

        return $lap;
    }

    protected function parseTrack(Activity $activity, \SimpleXMLElement $trackNode)
    {
        foreach ($trackNode->Trackpoint as $trackpointNode) {
            $point = $this->parseTrackpoint($trackpointNode);
            if ($point) {
                $activity->addPoint($point);
            }
        }
    }

    protected function parseTrackpoint(\SimpleXMLElement $trackpointNode)
    {
        $point = new Point();
        $point->setElevation((float) $trackpointNode->AltitudeMeters);
        $point->setDistance((float) $trackpointNode->DistanceMeters);

        if (isset($trackpointNode->Position->LatitudeDegrees) &&
            isset($trackpointNode->Position->LongitudeDegrees)) {
            $point->setLatitude((float) $trackpointNode->Position->LatitudeDegrees);
            $point->setLongitude((float) $trackpointNode->Position->LongitudeDegrees);
        }

        $point->getTime()->modify((string) $trackpointNode->Time);

        if (isset($trackpointNode->HeartRateBpm->Value)) {
            $point->setHeartRate((int) $trackpointNode->HeartRateBpm->Value);
        }

        if ($trackpointNode->Extensions) {
            $activityExtensionChildren = $trackpointNode->Extensions->children('http://www.garmin.com/xmlschemas/ActivityExtension/v2');

            if (isset($activityExtensionChildren->TPX->Speed)) {
                $point->setSpeed($this->convertSpeed((float) $activityExtensionChildren->TPX->Speed));
            }

            if (isset($activityExtensionChildren->TPX->Watts)) {
                $point->setPower((float) $activityExtensionChildren->TPX->Watts);
            }

            if (isset($activityExtensionChildren->TPX->RunCadence)) {
                $point->setCadence((float) $activityExtensionChildren->TPX->RunCadence);
            }

            if (isset($activityExtensionChildren->TPX)) {
                $defaultExtensionChildren = $activityExtensionChildren->TPX->children('');

                if (isset($defaultExtensionChildren->Speed)) {
                    $point->setSpeed($this->convertSpeed((float) $defaultExtensionChildren->Speed));
                }

                if (isset($defaultExtensionChildren->Watts)) {
                    $point->setPower((float) $defaultExtensionChildren->Watts);
                }

                if (isset($defaultExtensionChildren->RunCadence)) {
                    $point->setCadence((float) $defaultExtensionChildren->RunCadence);
                }
            }
        }

        if (isset($trackpointNode->Cadence)) {
            $point->setCadence((float) $trackpointNode->Cadence);
        }

        return $point;
    }
}
