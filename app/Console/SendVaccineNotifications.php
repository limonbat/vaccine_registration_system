<?php

namespace App\Console;

use App\VaccineSchedule;
use App\Notifications\VaccineScheduleEmailNotification;
use Illuminate\Console\Command;

class SendVaccineNotifications extends Command
{
    protected $signature = 'vaccination:send-notifications';
    protected $description = 'Send vaccination notifications to users at 9 PM';


    public function handle()
    {
        $scheduleUsers = VaccineSchedule::getUserScheduleForNextDay();
        foreach ($scheduleUsers as $user) {
            $user->notify(new VaccineScheduleEmailNotification($user->schedule_date));
        }
    }
}
