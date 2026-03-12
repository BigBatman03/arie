<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;

class ModulesTableSeeder extends Seeder
{
    public function run()
    {
        $modules = [
            ['id' => 1, 'slug' => 'perception', 'name' => 'Percepcja emocji'],
            ['id' => 2, 'slug' => 'usage', 'name' => 'Wykorzystanie emocji'],
            ['id' => 3, 'slug' => 'understanding', 'name' => 'Rozumienie emocji'],
            ['id' => 4, 'slug' => 'management', 'name' => 'Zarządzanie emocjami'],
            // SSEIT moved to own table, removed from modules
        ];

        foreach ($modules as $m) {
            Module::create($m);
        }
    }
}
