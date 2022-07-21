<?php

namespace Services;

abstract class AverageTemperatureCalculator
{
    public static function calculate($data)
    {
        $averageTemperature = [];
        $temperatures = [];
        $previousIntervalKey = null;

        do {
            $temperature = next($data);
            $date = key($data);
            $intervalKey = static::getIntervalKey($date);

            if ($previousIntervalKey && $previousIntervalKey != $intervalKey) {
                $averageTemperature[] = [
                    'label' => static::getLabel($date),
                    'value' => array_sum($temperatures) / count($temperatures),
                ];
                $temperatures = [];
            }
            if (!$date) {
                break;
            }

            $temperatures[] = $temperature;
            $previousIntervalKey = $intervalKey;
        } while ($temperatures);

        return $averageTemperature;
    }

    protected static function getLabel($date)
    {
        static $counter;
        if (!isset($counter)) {
            $counter = 0;
        }
        $counter++;
        return $counter;
    }

    protected abstract static function getIntervalKey($date);
}
