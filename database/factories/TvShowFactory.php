<?php

namespace Database\Factories;

use App\Models\TvShow;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TvShow>
 */
class TvShowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TvShow::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2, true),
            'description' => $this->faker->paragraphs(2, true),
            'banner' => 'banners/' . $this->faker->image('public/storage/banners', 640, 480, null, false),
            'start_date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),
        ];
    }
}
