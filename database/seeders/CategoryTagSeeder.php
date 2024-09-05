<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTag;

class CategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $tags = [
            ['name' => 'Cibo', 'slug' => 'cibo'],
            ['name' => 'Trasporti', 'slug' => 'trasporti'],
            ['name' => 'Intrattenimento', 'slug' => 'intrattenimento'],
            ['name' => 'Salute', 'slug' => 'salute'],
            ['name' => 'Viaggio', 'slug' => 'viaggio'],
            ['name' => 'Istruzione', 'slug' => 'istruzione'],
        ];

       
        foreach ($tags as $tag) {
            CategoryTag::create($tag);
        }
    }
}
