<?php

define('NUM_DOSES', 28);

$dt1 = new \DateTime;
$courseStart = '29.11.2018';
$period = '3 months';

$courseStartDtTm = $dt1->createFromFormat('d.m.Y', $courseStart);
echo 'Course start: ' . var_export($courseStartDtTm->format('Y-m-d'), 1) . PHP_EOL;
$courseEndDtTm = clone $courseStartDtTm;
$courseEndDtTm = $courseEndDtTm->modify('+3 month');
echo 'Course end: ' . var_export($courseEndDtTm->format('Y-m-d'), 1) . PHP_EOL;

$interval = \DateInterval::createFromDateString('1 day');
$datesPeriod = new \DatePeriod($courseStartDtTm, $interval, $courseEndDtTm);

$box = 1;
$dosesLeft = NUM_DOSES;
$dosesUsed = 0;
$daysInCourse = 0;
foreach ($datesPeriod as $dt) {
    $daysInCourse ++;
    //
    $dosesLeft -= 1;
    $dosesUsed ++;
    //
    echo 'Day ' . $daysInCourse . ': ' . var_export($dt->format('Y-m-d'), 1) . ' box: ' . $box . ' doses used: ' . $dosesUsed . ' doses left: ' . $dosesLeft . PHP_EOL;
    //
    if ($dosesLeft <= 1) {
        $box ++;
        $dosesLeft = NUM_DOSES;
    }
}
