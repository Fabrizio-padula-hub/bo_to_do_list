<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $newNeme = fake()->unique()->name();

        return [
            'user_id' => 1,
            'name' => $newNeme,
            'slug' => Str::slug($newNeme, '-')
        ];
    }
}
