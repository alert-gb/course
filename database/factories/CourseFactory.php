<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' =>$title = $this->faker->word(),
            'slug' => Str::slug($title, '-'),
            'description' => $this->faker->paragraph(2),
            'photo' => $this->faker->image('public/images/courses/', fullPath: false, word: 'category', category: 'courses'),
            'category_id' => rand(1, 9),
        ];
    }
}
