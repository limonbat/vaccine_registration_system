<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{

    static function hasAvailableCapacity($vaccineCenterId): bool
    {
        $totalRegistrations = Registration::where('scheduled_date', now()->toDateString())
            ->where('vaccine_center_id', $vaccineCenterId)
            ->count();

        $vaccineCenter = self::find($vaccineCenterId);
        if (!$vaccineCenter) {
            return false;
        }

        $availableCapacity = $vaccineCenter->capacity;
        return $availableCapacity > $totalRegistrations;
    }
}
