<?php

define('NUM_DOSES', 60);

$dt1 = new \DateTime;
$courseStart = '21.01.2020';
$period = '90 days'; // end date to check 20.04.2020
$flaconPrice = 270.00;

$courseStartDtTm = $dt1->createFromFormat('d.m.Y', $courseStart);
echo 'Course start date: ' . var_export($courseStartDtTm->format('Y-m-d'), 1) . PHP_EOL;
$courseEndDtTm = clone $courseStartDtTm;
$courseEndDtTm = $courseEndDtTm->modify('+3 month');
echo 'Course end date: ' . var_export($courseEndDtTm->format('Y-m-d'), 1) . PHP_EOL;

$interval = \DateInterval::createFromDateString('1 day');
$datesPeriod = new \DatePeriod($courseStartDtTm, $interval, $courseEndDtTm);

$flacon = 1;
$dosesLeft = NUM_DOSES;
$dosesUsed = 0;
$daysInCourse = 0;
foreach ($datesPeriod as $dt) {
    $daysInCourse ++;
    if ($daysInCourse == 1) {
        $dosesPerDay = 2;
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
    if ($dosesLeft <= $dosesPerDay) {
        $flacon ++;
        $dosesLeft = NUM_DOSES;
    }
}
echo 'Course total price: ' . ($flaconPrice * $flacon) . ' UAH' . PHP_EOL;
