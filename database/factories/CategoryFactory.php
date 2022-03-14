<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = $this->faker->paragraph,
            'slug' => Str::slug($title, '-'),
            'photo' => $this->faker->image('public/images/categories/', fullPath: false, word: 'category', category: 'courses'),
        ];
    }
}
