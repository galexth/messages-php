<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\Message;
use App\Models\Phone;
use App\Models\Sms;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Phone::truncate();
        Email::truncate();
        Sms::truncate();
        Message::truncate();

        Phone::factory(5)
            ->has(Message::factory()->count(3)->phone())
            ->create();

        Email::factory(5)
            ->has(Message::factory()->count(3)->email())
            ->create();

        Sms::factory(5)
            ->has(Message::factory()->count(3)->sms())
            ->create();
    }
}
