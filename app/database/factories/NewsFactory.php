<?php

namespace Database\Factories;

use App\Enums\NewsStringEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'short_description' => $this->faker->text(512),
            'description' => $this->faker->text(1024),
            'status' => $this->getRandomStatus(),
        ];
    }

    private function getRandomStatus(): string
    {
        $availableStatuses = NewsStringEnum::cases();

        return $availableStatuses[array_rand($availableStatuses)]->value;
    }
}
