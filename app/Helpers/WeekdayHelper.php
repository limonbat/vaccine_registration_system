<?php

namespace App\Helpers;
use DateInterval;

class WeekdayHelper
{
    private const WEEKDAYS = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
    ];


    public static function getNextWeekday(\DateTime $date): \DateTime
    {
        do {
            $date->add(new DateInterval('P1D'));
        } while (!self::isWeekday($date));

        return $date;
    }


    private static function isWeekday(\DateTime $date): bool
    {
        return in_array($date->format('l'), self::WEEKDAYS, true);
    }
}
