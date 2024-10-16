<?php

namespace App\Http\Controllers;

use App\Registration;
use App\VaccineCenter;
use App\VaccineSchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DistributionController extends Controller
{
    public object $latestSchedules;

    public function __invoke(): void
    {
        try {
            DB::beginTransaction();
            $registeredUsers = Registration::where('is_scheduled', 0)->get();
            if (!count($registeredUsers)) {
                echo "Register User Data Not Fond";
                exit();
            }

            $vaccineCenterCapacities = VaccineCenter::all()->pluck('capacity', 'id')->toArray();

            $scheduledData = $this->scheduleRegisteredUsers($registeredUsers, $vaccineCenterCapacities);

            VaccineSchedule::insert($scheduledData);

            $scheduledUserIds = array_column($scheduledData, 'registered_user_id');
            Registration::whereIn('id', $scheduledUserIds)->update(['is_scheduled' => 1]);

            DB::commit();
            echo "Successfully Scheduled registered user";
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            echo "Error: " . $exception->getMessage();
        }
    }

    private function scheduleRegisteredUsers($registeredUsers, $vaccineCenterCapacities): array
    {
        $scheduledUserData = [];
        $currentCapacities = $vaccineCenterCapacities;

        // Get latest schedule dates for each vaccine center
        $this->latestSchedules = VaccineSchedule::select('vaccine_center_id', DB::raw('MAX(schedule_date) as latest_date'))
            ->groupBy('vaccine_center_id')
            ->pluck('latest_date', 'vaccine_center_id')
            ->toArray();

        $schedulingDate = "";
        foreach ($registeredUsers as $user) {

            $vaccineCenterId = $user->vaccine_center_id;

            #  Fetch or initialize the latest scheduling date for the vaccine center
            if (empty($latestScheduleDates[$vaccineCenterId])) {
                $latestScheduleDate = $this->getLatestScheduleDate($vaccineCenterId);
                $date = Carbon::createFromFormat('Y-m-d', $latestScheduleDate);
                $latestScheduleDates[$vaccineCenterId] = $this->getNextWeekday($date->copy()->addDay());
            }

            $latestScheduleDate = $latestScheduleDates[$vaccineCenterId];

            # If the capacity is full, reset and move to the next available date
            if ($currentCapacities[$vaccineCenterId] <= 0) {
                $currentCapacities = $vaccineCenterCapacities;
                $schedulingDate = $this->getNextWeekday($latestScheduleDate->copy()->addDay());
            }

            $scheduledUserData[] = [
                'registered_user_id' => $user->id,
                'vaccine_center_id' => $vaccineCenterId,
                'schedule_date' => $latestScheduleDate->toDateString(),
                'created_at' => now(),
                'updated_at' => now()
            ];

            #  Update scheduling and capacity tracking
            $latestScheduleDates[$vaccineCenterId] = $schedulingDate;
            $currentCapacities[$vaccineCenterId]--;
        }
        return $scheduledUserData;
    }

    private function getLatestScheduleDate($vaccineCenterId)
    {
        $today = date('Y-m-d');
        if (empty($this->latestSchedules[$vaccineCenterId])) return $today;

        return ($this->latestSchedules[$vaccineCenterId] > $today) ? $this->latestSchedules[$vaccineCenterId] : $today;
    }

    function getNextWeekday($date)
    {
        while (!$date->isSunday() && !$date->isMonday() && !$date->isTuesday() && !$date->isWednesday() && !$date->isThursday()) {
            $date->addDay();
        }
        return $date;
    }
}
