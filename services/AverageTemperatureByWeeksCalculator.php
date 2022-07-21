<?php

namespace Services;

class AverageTemperatureByWeeksCalculator extends AverageTemperatureCalculator
{
    protected static function getIntervalKey($date)
    {
        $date = date("W", strtotime($date));
        return $date;
    }
}
