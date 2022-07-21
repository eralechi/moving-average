<?php

namespace Services;

class MovingAverageCalculator
{
    const PRECISION = 2;

    public static function calculate($data, $n)
    {
        $initialValues = [];
        $movingAverageValues = [];

        for ($i = 0; $i < count($data); $i++) {
            $label = (string) $data[$i]['label'];
            $initialValues[$label] = round($data[$i]['value'], self::PRECISION);
        
            if ($i < $n)
                continue;
        
            $previousSum = 0;
            for ($j = $i-$n; $j < $i; $j++) {
                $previousSum += $data[$j]['value'];
            }
            
            $movingAverageValues[$label] = round($previousSum / $n, self::PRECISION);
        }

        $result = [
            'Temperature' => $initialValues,
            'Simple moving average' => $movingAverageValues,
        ];
        return $result;
    }
}
