<?php

namespace Services;

class CalculatorController
{
    private $action;

    function __construct($action) 
    {
        $this->action = $action;
    }

    public function calculate($data)
    {
        $action = $this->action;
        switch ($action) {
            case 'by-month':
                return AverageTemperatureByMonthCalculator::calculate($data);
        
            case 'by-weeks':
                return AverageTemperatureByWeeksCalculator::calculate($data);
        
            case 'by-days':
                return AverageTemperatureByDaysCalculator::calculate($data);
            default:
                return [];
        }
    }
}
