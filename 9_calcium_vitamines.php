<?php

define('NUM_DOSES', 30);

// вітаміни: Кальцемін адванс
// призначила: Бакшутова Наталя Олексіївна
// приймати 1 місяць по 1 таблетці на день


$dt1 = new \DateTime;
$courseStart = '10.10.2023';
$boxPrice = 191;
$dosesPerDay = 1;
$firstDayDoses = 1;

$courseStartDtTm = $dt1->createFromFormat('d.m.Y', $courseStart);
echo 'Course start date: ' . var_export($courseStartDtTm->format('Y-m-d'), 1) . PHP_EOL;
$courseEndDtTm = clone $courseStartDtTm;
$courseEndDtTm = $courseEndDtTm->modify('+30 day');
echo 'Course end date: ' . var_export($courseEndDtTm->format('Y-m-d'), 1) . PHP_EOL . PHP_EOL;

$interval = \DateInterval::createFromDateString('1 day');
$datesPeriod = new \DatePeriod($courseStartDtTm, $interval, $courseEndDtTm);

$box = 1;
$dosesLeft = NUM_DOSES;
$dosesUsed = 0;
$daysInCourse = 0;

foreach ($datesPeriod as $dt) {
    $daysInCourse ++;
    if (($daysInCourse == 1)
        && ($firstDayDoses != $dosesPerDay)
    ) {
        $dosesUsed += $firstDayDoses;
        $dosesLeft -= $firstDayDoses;
    } else {
        $dosesUsed += $dosesPerDay;
        $dosesLeft -= $dosesPerDay;
    }
    echo 'Day ' . $daysInCourse . ': ' . var_export($dt->format('Y-m-d'), 1) .
        ' doses used: ' . $dosesUsed .
        ' doses left: ' . $dosesLeft . PHP_EOL;
}
