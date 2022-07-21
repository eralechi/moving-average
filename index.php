<?php
require_once './vendor/autoload.php';

$actions = [
    'by-days' => 'по дням',
    'by-weeks' => 'по неделям',
    'by-month' => 'по месяцам',
];

$default_n = 3;
$uploadFolder = __DIR__ . '/upload/';
$filePath = $uploadFolder . 'temperature.csv';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$n = isset($_REQUEST['n']) && intval($_REQUEST['n']) ? intval($_REQUEST['n']) : $default_n;
$n = $n < 0 ? $default_n : $n;

$parsedData = Services\TemperatureCsvFileParcer::parce($filePath);
$calculatorController = new Services\CalculatorController($action);
$averageTemperature = $calculatorController->calculate($parsedData);

if ($averageTemperature) {
    $chartValues = Services\MovingAverageCalculator::calculate($averageTemperature, $n);
    $labels = array_keys(reset($chartValues));
}

include_once './view/main.php';
