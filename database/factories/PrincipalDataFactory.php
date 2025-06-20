<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrincipalData>
 */
class PrincipalDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'id_card' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->unique()->numberBetween(910000000, 999999999),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indica un nombre específico
     */
    public function withName(string $name)
    {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name,
            ];
        });
    }

    /**
     * Indica un apellido específico
     */
    public function withLastname(string $lastname)
    {
        return $this->state(function (array $attributes) use ($lastname) {
            return [
                'lastname' => $lastname,
            ];
        });
    }

    /**
     * Indica un email específico
     */
    public function withEmail(string $email)
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email,
            ];
        });
    }
}
