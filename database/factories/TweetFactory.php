<?php

namespace Database\Factories;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TweetFactory extends Factory
{
    protected $model = Tweet::class;

    public function definition()
    {
        return [
            'text' => $this->faker->text(160),
            'likes' => $this->faker->numberBetween(0, 20000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
