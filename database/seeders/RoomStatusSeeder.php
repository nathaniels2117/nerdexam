<?php

namespace Database\Seeders;

use App\Models\RoomStatus;
use Illuminate\Database\Seeder;

class RoomStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomStatus::firstOrCreate([
            'name' => 'clean',
            'color' => 'any'
        ]);

        RoomStatus::firstOrCreate([
            'name' => 'occupied',
            'color' => 'red '
        ]);

        RoomStatus::firstOrCreate([
            'name' => 'dirty',
            'color' => 'any'
        ]);
    }
}
