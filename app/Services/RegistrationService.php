<?php

namespace App\Services;

use App\Exceptions\RegistrationException;
use App\Registration;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrationService
{
    /**
     * Registers a new user for vaccination at a specified vaccine center.
     *
     * This method performs the following steps:
     * 1. Checks if the selected vaccine center has available capacity.
     * 2. Creates a new user in the system based on the provided data.
     * 3. Registers the user for vaccination at the specified center.
     * 4. Commits the database transaction if successful or rolls back in case of an error.
     *
     * @param array $userData An associative array containing user data:
     *  - 'name' => string, the user's name.
     *  - 'nid' => string, the user's national ID.
     *  - 'email' => string, the user's email address.
     *  - 'address' => string, the user's address.
     *  - 'vaccine_center' => int, the ID of the vaccine center.
     *
     * @return string A success message if registration completes, or an error message on failure.
     *
     * @throws RegistrationException if the vaccine center has no available capacity.
     */
    public function registerUser(array $userData): string
    {
        DB::beginTransaction();
        try {

            $userInstance = User::create([
                'name' => $userData['name'],
                'nid' => $userData['nid'],
                'email' => $userData['email'],
                'address' => $userData['address'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Registration::create([
                'user_id' => $userInstance->id,
                'vaccine_center_id' => $userData['vaccine_center'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            return 'Registration completed successfully.';
        } catch (RegistrationException|\Exception $exception) {
            Log::error("Registration failed: " . $exception->getMessage());
            DB::rollBack();
            return "Registration failed: " . $exception->getMessage();;
        }
    }
}
