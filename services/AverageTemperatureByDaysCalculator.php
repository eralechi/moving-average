<?php

namespace Services;

class AverageTemperatureByDaysCalculator extends AverageTemperatureCalculator
{
    protected static function getIntervalKey($date)
    {
        $date = date("d.m.Y", strtotime($date));
        return $date;
    }
    protected static function getLabel($date)
    {
        return static::getIntervalKey($date);
    }
}
