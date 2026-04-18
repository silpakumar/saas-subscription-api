<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'id' => Str::uuid(),
            'name' => 'Basic',
            'price' => 199
        ]);

        Plan::create([
            'id' => Str::uuid(),
            'name' => 'Pro',
            'price' => 499
        ]);

        Plan::create([
            'id' => Str::uuid(),
            'name' => 'Enterprise',
            'price' => 999
        ]);
    }
}
