<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Phone;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = \Faker\Factory::create();
        $faker = \Faker\Factory::create();

        // call the factory Phone
        Phone::factory()->count(100)->create();
    }
}
