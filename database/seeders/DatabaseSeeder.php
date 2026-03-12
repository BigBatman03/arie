<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Module;
use App\Models\Exercise;
use App\Models\ExerciseOption;
use App\Models\SseitQuestion;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Wyczyść tabele (tylko raz na początku)
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SseitQuestion::truncate(); // Clean up SSEIT questions
        ExerciseOption::truncate();
        Exercise::truncate();
        Module::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Uruchom poszczególne seedery w odpowiedniej kolejności
        $this->call([
            ModulesTableSeeder::class,      // Najpierw moduły, bo ćwiczenia muszą się do nich odwoływać
            PerceptionSeeder::class,
            UsageSeeder::class,
            UnderstandingSeeder::class,
            ManagementSeeder::class,
            SseitSeeder::class,
        ]);
    }
}
