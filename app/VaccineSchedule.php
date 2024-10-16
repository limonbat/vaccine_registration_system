<?php

namespace App;

use App\Helpers\WeekdayHelper;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class VaccineSchedule extends Model
{
    static function getUserScheduleForNextDay()
    {
        $currentDate = new DateTime();
        $date = WeekdayHelper::getNextWeekday($currentDate);
        return self::where('schedule_date',$date)
            ->join('registrations', 'users.id', '=', 'registrations.user_id')
            ->join('vaccine_schedules', 'registrations.id', '=', 'vaccine_schedules.registered_user_id')
            ->select('users.*','vaccine_schedules.schedule_date')
            ->get();
    }
}
