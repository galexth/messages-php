<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $email = $this->faker->safeEmail;
        $pass = $this->faker->password;

        return [
            'email' => $email,
            'activity' => Carbon::now(),
            'settings' => [
                'send' => [
                    'host' => 'smtp.gmail.com',
                    'port' => 465,
                    'login' => $email,
                    'password' => $pass,
                    'secure' => $this->faker->boolean
                ],
            ],
        ];
    }
}
