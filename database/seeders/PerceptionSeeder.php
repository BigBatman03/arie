<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class PerceptionSeeder extends Seeder
{
    public function run()
    {
        $moduleId = 1;

        $addPerception = function($path, $correct, $wrong1, $wrong2, $wrong3) use ($moduleId) {
            $ex = Exercise::create([
                'module_id' => $moduleId,
                'type' => 'image_identify',
                'media_path' => $path,
                'config' => ['correct_text' => $correct]
            ]);
            $ex->options()->createMany([
                ['text' => $correct, 'is_correct' => true],
                ['text' => $wrong1, 'is_correct' => false],
                ['text' => $wrong2, 'is_correct' => false],
                ['text' => $wrong3, 'is_correct' => false],
            ]);
        };

        $addPerception('photoemocje/sad1.jpg', 'Smutek', 'Złość', 'Wstręt', 'Strach');
        $addPerception('photoemocje/sad2.jpg', 'Smutek', 'Zaskoczenie', 'Radość', 'Wstręt');
        $addPerception('photoemocje/sad3.jpg', 'Smutek', 'Strach', 'Złość', 'Radość');
        $addPerception('photoemocje/sad4.jpg', 'Smutek', 'Wstręt', 'Zaskoczenie', 'Złość');
        $addPerception('photoemocje/sad5.jpg', 'Smutek', 'Strach', 'Radość', 'Złość');
        $addPerception('photoemocje/sad6.jpg', 'Smutek', 'Wstręt', 'Zaskoczenie', 'Strach');
        $addPerception('photoemocje/sad7.jpg', 'Smutek', 'Złość', 'Radość', 'Wstręt');

        $addPerception('photoemocje/happy1.jpg', 'Radość', 'Zaskoczenie', 'Wstręt', 'Smutek');
        $addPerception('photoemocje/happy2.jpg', 'Radość', 'Złość', 'Strach', 'Smutek');
        $addPerception('photoemocje/happy3.jpg', 'Radość', 'Zaskoczenie', 'Wstręt', 'Strach');
        $addPerception('photoemocje/happy4.jpg', 'Radość', 'Smutek', 'Złość', 'Wstręt');
        $addPerception('photoemocje/happy5.jpg', 'Radość', 'Zaskoczenie', 'Strach', 'Wstręt');
        $addPerception('photoemocje/happy6.jpg', 'Radość', 'Złość', 'Smutek', 'Strach');
        $addPerception('photoemocje/happy7.jpg', 'Radość', 'Wstręt', 'Zaskoczenie', 'Złość');

        $addPerception('photoemocje/angry1.jpg', 'Złość', 'Wstręt', 'Strach', 'Smutek');
        $addPerception('photoemocje/angry2.jpg', 'Złość', 'Zaskoczenie', 'Radość', 'Wstręt');
        $addPerception('photoemocje/angry3.jpg', 'Złość', 'Strach', 'Smutek', 'Zaskoczenie');
        $addPerception('photoemocje/angry4.jpg', 'Złość', 'Wstręt', 'Zaskoczenie', 'Strach');
        $addPerception('photoemocje/angry5.jpg', 'Złość', 'Smutek', 'Radość', 'Strach');
        $addPerception('photoemocje/angry6.jpg', 'Złość', 'Wstręt', 'Zaskoczenie', 'Smutek');
        $addPerception('photoemocje/angry7.jpg', 'Złość', 'Strach', 'Zaskoczenie', 'Radość');

        $addPerception('photoemocje/scared1.jpg', 'Strach', 'Zaskoczenie', 'Smutek', 'Wstręt');
        $addPerception('photoemocje/scared2.jpg', 'Strach', 'Złość', 'Zaskoczenie', 'Radość');
        $addPerception('photoemocje/scared3.jpg', 'Strach', 'Wstręt', 'Smutek', 'Złość');
        $addPerception('photoemocje/scared4.jpg', 'Strach', 'Zaskoczenie', 'Wstręt', 'Radość');

        $addPerception('photoemocje/disgusted1.jpg', 'Wstręt', 'Złość', 'Strach', 'Smutek');
        $addPerception('photoemocje/disgusted2.jpg', 'Wstręt', 'Zaskoczenie', 'Złość', 'Strach');
        $addPerception('photoemocje/disgusted3.jpg', 'Wstręt', 'Smutek', 'Złość', 'Radość');
        $addPerception('photoemocje/disgusted4.jpg', 'Wstręt', 'Strach', 'Zaskoczenie', 'Złość');

        $addPerception('photoemocje/surprised1.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Wstręt');
        $addPerception('photoemocje/surprised2.jpg', 'Zaskoczenie', 'Radość', 'Strach', 'Złość');
        $addPerception('photoemocje/surprised3.jpg', 'Zaskoczenie', 'Złość', 'Smutek', 'Wstręt');
        $addPerception('photoemocje/surprised4.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Smutek');
        $addPerception('photoemocje/surprised5.jpg', 'Zaskoczenie', 'Wstręt', 'Smutek', 'Złość');
        $addPerception('photoemocje/surprised6.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Wstręt');
        $addPerception('photoemocje/surprised7.jpg', 'Zaskoczenie', 'Radość', 'Smutek', 'Złość');
    }
}
