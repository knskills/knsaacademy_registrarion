<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\audience as Audience;

class AudianceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 1000 audiance using facker
        $audiance = [
            [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'phone' => fake()->phoneNumber(),
            ]
        ];

        // create 1000 audiance using facker
        for ($i = 0; $i < 1000; $i++) {
            $audiance[] = [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'phone' => fake()->phoneNumber(),
            ];
        }

        // insert audiance
        Audience::insert($audiance);
    }
}
