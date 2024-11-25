<?php

namespace Database\Factories;

use App\Models\Albumn;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $album = Albumn::count() > 0 && fake()->boolean(50) 
            ? Albumn::inRandomOrder()->first()
            : null;

        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'date' => fake()->dateTime(),
            'image_path' => fake()->filePath(),
            'albumn_id' => $album ? $album->id : null,
            'user_id' => $album ? $album->user_id : User::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
