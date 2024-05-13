<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WhatsappApi;

class WhatsappSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create database
        WhatsappApi::create([
            "about" => "Empowering through network and direct marketing expertise. Elevate your skills with us.",
            "address" => "Yashika Medishop, Geetanjali Colony, Shankar Nagar, Raipur, Chhattisgarh 492007",
            "description" => "KN Skill Academy - A network and direct marketing skills development academy.",
            "vartical" => "EDU",
            "email" => "info@knsacademy.in",
            "website_1" => "https://knsacademy.in/",
            'image' => 'test',
        ]);
    }
}
