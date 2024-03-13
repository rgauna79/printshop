<?php

namespace Database\Factories;

use App\Models\BrandModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BrandModel>
 */
class BrandFactory extends Factory
{
    protected $model = BrandModel::class;
    
    public function definition(): array
    {
        $name = $this->faker->words(2, true);
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'meta_keywords' => $this->faker->words(5, true),
            'created_by' => 1,
            'status' => 0,
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
