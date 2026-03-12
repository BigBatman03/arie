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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SseitQuestion::truncate();
        ExerciseOption::truncate();
        Exercise::truncate();
        Module::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            ModulesTableSeeder::class,
            PerceptionSeeder::class,
            UsageSeeder::class,
            UnderstandingSeeder::class,
            ManagementSeeder::class,
            SseitSeeder::class,
        ]);
    }
}
