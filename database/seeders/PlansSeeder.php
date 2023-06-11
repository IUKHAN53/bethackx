<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Free',
            'description' => 'Free plan',
            'price' => 0,
            'status' => 1,
            'company_id' => Company::query()->first()->id,
        ]);
        Plan::create([
            'name' => 'Premium',
            'description' => 'Premium plan',
            'price' => 100,
            'status' => 1,
            'company_id' => Company::query()->first()->id,
        ]);
    }
}
