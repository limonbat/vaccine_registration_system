<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VaccineStatusController extends Controller
{
    public function showStatusForm()
    {
        return view('status');
    }

    public function checkStatus(Request $request): void
    {
        $nid = $request->get('nid', '');
        $userData = DB::table('registrations')
            ->join('users', 'registrations.user_id', '=', 'users.id')
            ->leftJoin('vaccine_schedules', 'registrations.id', '=', 'vaccine_schedules.registered_user_id')
            ->select('registrations.is_scheduled', 'vaccine_schedules.schedule_date')
            ->where('users.nid', $nid)
            ->first();

        if (!$userData) {
            echo "<h3 style='text-align: center' >Not registered</h3>";
            exit();
        }

        if ($userData->is_scheduled == 0) {
            echo "<h3 style='text-align: center' >Not scheduled</h3>";
            exit();
        }

        if ($userData->is_scheduled == 1) {
            if ($userData->schedule_date > date('Y-m-d')) {
                echo "<h3 style='text-align: center' >Scheduled Date: " . $userData->schedule_date."</h3>";
            } else {
                echo "<h3 style='text-align: center' >Vaccinated</h3>";
            }
            exit();
        }
    }
}
