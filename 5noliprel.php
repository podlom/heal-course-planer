<?php

define('NUM_DOSES', 30);

$dt1 = new \DateTime;
$courseStart = '21.01.2020';
$period = '90 days'; // end date to check 20.04.2020
$boxPrice = 160.00;

$courseStartDtTm = $dt1->createFromFormat('d.m.Y', $courseStart);
echo 'Course start date: ' . var_export($courseStartDtTm->format('Y-m-d'), 1) . PHP_EOL;
$courseEndDtTm = clone $courseStartDtTm;
$courseEndDtTm = $courseEndDtTm->modify('+3 month');
echo 'Course end date: ' . var_export($courseEndDtTm->format('Y-m-d'), 1) . PHP_EOL;

$interval = \DateInterval::createFromDateString('1 day');
$datesPeriod = new \DatePeriod($courseStartDtTm, $interval, $courseEndDtTm);

$box = 1;
$dosesLeft = NUM_DOSES;
$dosesUsed = 0;
$daysInCourse = 0;
$dosesPerDay = 1;
foreach ($datesPeriod as $dt) {
    $daysInCourse ++;
    $dosesUsed += $dosesPerDay;
    $dosesLeft -= $dosesPerDay;
    echo 'Day ' . $daysInCourse . ': ' . var_export($dt->format('Y-m-d'), 1) .
        ' box: ' . $box .
        ' doses used: ' . $dosesUsed .
        ' doses left: ' . $dosesLeft . PHP_EOL;
    if ($dosesLeft == $dosesPerDay) {
        $box ++;
        $dosesLeft = NUM_DOSES;
    }
}
echo 'Course total price: ' . ($boxPrice * $box) . ' UAH' . PHP_EOL;
