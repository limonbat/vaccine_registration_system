<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineCentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vaccine_centers')->insert([
            [
                'id' => 1,
                'name' => 'Parshuram Hospital',
                'capacity' => 2,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Feni Hospital',
                'capacity' => 2,
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'Fulgazi Hospital',
                'capacity' => 3,
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);
    }
}
