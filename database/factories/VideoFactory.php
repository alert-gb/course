<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $title = $this->faker->paragraph(1),
            'slug' => Str::slug($title, '-'),
            'path' => rand(1, 6) . '.mp4',
            'section_id' => rand(1, 900),
        ];
    }
}
