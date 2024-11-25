<?php

namespace Database\Factories;

use App\Models\Albumn;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Albumn>
 */
class AlbumnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'date' => fake()->dateTime(),
            'image_path' => fake()->filePath(),
            'user_id' => User::inRandomOrder()->first()->id,
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Albumn $albumn) {
            if (Albumn::count() > 1 && fake()->boolean(50)) {
                $parentAlbum = Albumn::where('id', '!=', $albumn->id)
                    ->inRandomOrder()->first();
                $albumn->update([
                    'parent_id' => $parentAlbum->id,
                    'user_id' => $parentAlbum->user_id,
                ]);
            }
        });
    }
}
