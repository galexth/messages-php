<?php

namespace Database\Factories;

use App\Enums\EmailStatus;
use App\Enums\PhoneStatus;
use App\Enums\SmsStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function email()
    {
        return $this->state(function (array $attributes) {
            return [
                'to' => $this->faker->safeEmail,
                'text' => $this->faker->text(1000),
                'status' => $this->faker->randomElement(EmailStatus::all()),
            ];
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function sms()
    {
        return $this->state(function (array $attributes) {
            return [
                'to' => $this->faker->phoneNumber,
                'text' => $this->faker->text(255),
                'status' => $this->faker->randomElement(SmsStatus::all()),
            ];
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function phone()
    {
        return $this->state(function (array $attributes) {
            return [
                'to' => $this->faker->phoneNumber,
                'status' => $this->faker->randomElement(PhoneStatus::all()),
            ];
        });
    }
}
