<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->safeEmail(),
            'bio' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'social_media' => json_encode([
                'facebook' => $this->faker->url(),
                'twitter' => $this->faker->url(),
                'linkedin' => $this->faker->url(),
            ]),
            'profession' => $this->faker->jobTitle(),
        ];
    }
}
