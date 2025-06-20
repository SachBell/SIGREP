<?php

namespace Database\Factories;

use App\Models\Career;
use App\Models\ReceivingEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CareerEntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => ReceivingEntity::factory(),
            'career_id' => Career::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Para asignar una entidad específica
     */
    public function forReceivingEntity($receivingEntityId)
    {
        return $this->state(function (array $attributes) use ($receivingEntityId) {
            return [
                'receiving_entity_id' => $receivingEntityId,
            ];
        });
    }

    /**
     * Para asignar una carrera específica
     */
    public function forCareer($careerId)
    {
        return $this->state(function (array $attributes) use ($careerId) {
            return [
                'career_id' => $careerId,
            ];
        });
    }
}
