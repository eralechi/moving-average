<?php

namespace Services;

class TemperatureCsvFileParcer
{
    public static function parce($path)
    {
        $parsedData = [];
        $data = file($path);

        if (!empty($data) && is_array($data)) {
            foreach ($data as $row) {
                $row = array_map('trim',explode(";", $row));
                $date = $row[1] . "-" . $row[2] . "-" . $row[3];
                $parsedData[$date] = $row[4];
            }
        }
        return $parsedData;
    }
}
