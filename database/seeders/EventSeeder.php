<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => 'first event',
                'event_date' => '2021-09-30',
                'event_start_time' => '10:00:00',
                'event_end_time' => '11:00:00',
                'event_link' => 'https://www.google.com',
                'event_image' => 'https://www.google.com',
                'event_description' => 'Event 1 description',
                'youtube_link' => 'https://www.google.com',
                'button_text' => 'Event 1 button text',
                'price' => '100',
                'payment_link' => 'https://www.google.com',
                'is_active' => '1',
                'whatsapp_link' => 'https://www.google.com',
                'event_type' => 'free',
                'event_language' => 'Hindi',
                'event_duration' => '1 hour',
                'timer_time' => '60',
                'original_price' => '100',
                'slug' => 'event-1',
            ],
            [
                'event_name' => 'beginner_to_billionaire',
                'event_date' => '2024-01-24',
                'event_start_time' => '7:00:00',
                'event_end_time' => '8:00:00',
                'event_link' => 'https://www.google.com',
                'event_image' => 'https://www.google.com',
                'event_description' => 'Event 2 description',
                'youtube_link' => 'https://www.google.com',
                'button_text' => 'Event 2 button text',
                'price' => '100',
                'payment_link' => 'https://www.google.com',
                'is_active' => '1',
                'whatsapp_link' => 'https://www.google.com',
                'event_type' => 'free',
                'event_language' => 'Hindi',
                'event_duration' => '1 hour',
                'timer_time' => '60',
                'original_price' => '100',
                'slug' => 'event-2',
            ]
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
