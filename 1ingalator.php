<?php

define('NUM_DOSES', 60);

$dt1 = new \DateTime;
$courseStart = '29.11.2018';
$period = '3 months';
$flaconPrice = 441.95;

$courseStartDtTm = $dt1->createFromFormat('d.m.Y', $courseStart);
echo 'Course start: ' . var_export($courseStartDtTm->format('Y-m-d'), 1) . PHP_EOL;
$courseEndDtTm = clone $courseStartDtTm;
$courseEndDtTm = $courseEndDtTm->modify('+3 month');
echo 'Course end: ' . var_export($courseEndDtTm->format('Y-m-d'), 1) . PHP_EOL;

$interval = \DateInterval::createFromDateString('1 day');
$datesPeriod = new \DatePeriod($courseStartDtTm, $interval, $courseEndDtTm);

$flacon = 1;
$dosesLeft = NUM_DOSES;
$dosesUsed = 0;
$daysInCourse = 0;
foreach ($datesPeriod as $dt) {
    $daysInCourse ++;
    //
    if ($daysInCourse == 1) {
        $dosesPerDay = 1;
        $dosesLeft -= $dosesPerDay;
        $dosesUsed += $dosesPerDay;
    } else {
        $dosesPerDay = 2;
        $dosesLeft -= $dosesPerDay;
        $dosesUsed += $dosesPerDay;
    }
    //
    echo 'Day ' . $daysInCourse . ': ' .
        var_export($dt->format('Y-m-d'), 1) .
        ' flacon: ' . $flacon .
        ' doses used: ' . $dosesUsed .
        ' doses left: ' . $dosesLeft . PHP_EOL;
    //
    if ($daysInCourse == 1) {
        if ($dosesLeft <= 1) {
            $flacon ++;
            $dosesLeft = NUM_DOSES;
        }
    } else {
        if ($dosesLeft <= 2) {
            $flacon ++;
            $dosesLeft = NUM_DOSES;
        }
    }
}
echo 'Course total price: ' . ($flaconPrice * $flacon) . ' UAH' . PHP_EOL;
