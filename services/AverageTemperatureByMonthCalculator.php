<?php

namespace Services;

class AverageTemperatureByMonthCalculator extends AverageTemperatureCalculator
{
    protected static function getIntervalKey($date)
    {
        $date = date("m", strtotime($date));
        return $date;
    }
}
