<?php

namespace Database\Factories;

use App\Models\PrincipalData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReceivingEntity>
 */
class ReceivingEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startDate = $this->faker->dateTimeBetween('-2 years', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');

        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'user_limit' => $this->faker->numberBetween(1, 20),
            'productive_sector' => $this->faker->randomElement(['Público', 'Privado']),
            'principal_data_id' => PrincipalData::factory(),
            'observations' => $this->faker->optional(0.7)->text(200),
            'convenant_start_date' => $startDate,
            'convenant_end_date' => $endDate,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indica que la entidad es del sector público
     */
    public function publicSector()
    {
        return $this->state(function (array $attributes) {
            return [
                'productive_sector' => 'Público',
            ];
        });
    }

    /**
     * Indica que la entidad es del sector privado
     */
    public function privateSector()
    {
        return $this->state(function (array $attributes) {
            return [
                'productive_sector' => 'Privado',
            ];
        });
    }

    /**
     * Establece un límite específico de usuarios
     */
    public function withUserLimit(int $limit)
    {
        return $this->state(function (array $attributes) use ($limit) {
            return [
                'user_limit' => $limit,
            ];
        });
    }

    /**
     * Establece fechas específicas para el convenio
     */
    public function withConvenantDates($startDate, $endDate)
    {
        return $this->state(function (array $attributes) use ($startDate, $endDate) {
            return [
                'convenant_start_date' => $startDate,
                'convenant_end_date' => $endDate,
            ];
        });
    }
}
