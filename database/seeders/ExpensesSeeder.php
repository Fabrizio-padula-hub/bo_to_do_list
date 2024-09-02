<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Expenses;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $newExpenses = new Expenses();
            $newExpenses->name = $faker->word();
            $newExpenses->image = 'https://picsum.photos/200/300';
            $newExpenses->slug = Str::slug($newExpenses->name, '-');
            $newExpenses->save();
        }
    }
}
