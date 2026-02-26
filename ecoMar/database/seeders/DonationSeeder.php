<?php

namespace Database\Seeders;

use App\Models\Donation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $rows = [
            ['name' => 'Ana Marques', 'num_donated' => 25.00, 'created_at' => $now->copy()->subDays(6)],
            ['name' => 'Tiago Alves', 'num_donated' => 15.50, 'created_at' => $now->copy()->subDays(5)],
            ['name' => 'Anónimo', 'num_donated' => 10.00, 'created_at' => $now->copy()->subDays(4)],
            ['name' => 'Carla Pereira', 'num_donated' => 40.00, 'created_at' => $now->copy()->subDays(3)],
            ['name' => 'Rui Costa', 'num_donated' => 18.75, 'created_at' => $now->copy()->subDays(2)],
            ['name' => 'Joana Silva', 'num_donated' => 32.00, 'created_at' => $now->copy()->subDay()],
            ['name' => 'Anónimo', 'num_donated' => 12.00, 'created_at' => $now],
            ['name' => 'Marta Rocha', 'num_donated' => 27.30, 'created_at' => $now],
        ];

        foreach ($rows as &$row) {
            $row['updated_at'] = $row['created_at'];
        }

        Donation::insert($rows);
    }
}
