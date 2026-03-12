<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SseitQuestion;

class SseitSeeder extends Seeder
{
    public function run()
    {
        $sseitData = [
            ['content' => 'Wiem, kiedy mówić innym o moich problemach osobistych.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Kiedy napotykam przeszkody, przypominam sobie sytuacje, w których podobne trudności udało mi się pokonać.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Spodziewam się, że większość spraw potoczy się po mojej myśli.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Inni ludzie łatwo mi się zwierzają.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Trudno mi zrozumieć komunikaty niewerbalne innych ludzi.*', 'subscale' => 'perception', 'is_reverse' => true],
            ['content' => 'Niektóre z najważniejszych wydarzeń w moim życiu skłoniły mnie do ponownej oceny tego, co jest ważne, a co nieważne.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Kiedy zmienia się mój nastrój, widzę nowe możliwości.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Emocje są jedną z rzeczy, dzięki którym warto żyć.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Jestem świadomy własnych emocji, kiedy ich doświadczam.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Spodziewam się, że wydarzą się dobre rzeczy.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Lubię dzielić się swoimi emocjami z innymi.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Kiedy odczuwam pozytywne emocje, wiem jak sprawić, by trwały długo.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Aranżuję wydarzenia sprawiające innym radość.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Szukam zajęć, które mnie uszczęśliwiają.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Jestem świadomy przekazu niewerbalnego, który wysyłam innym.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Prezentuję się w sposób, który robi dobre wrażenie na innych', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Kiedy jestem w dobrym nastroju, rozwiązywanie problemów jest dla mnie proste.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Potrafię rozpoznać emocje innych ludzi patrząc na mimikę ich twarzy.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Wiem, dlaczego moje emocje ulegają zmianie.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Kiedy jestem w dobrym nastroju, potrafię wymyślić wiele nowych pomysłów.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Mam kontrolę nad swoimi emocjami.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Łatwo rozpoznaję emocje innych.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Motywuję się, wyobrażając sobie dobry wynik działań, które podejmuję.', 'subscale' => 'own', 'is_reverse' => false],
            ['content' => 'Komplementuję innych, kiedy robią coś dobrze.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Jestem świadomy przekazu niewerbalnego innych ludzi.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Kiedy inna osoba mówi mi o ważnym wydarzeniu w swoim życiu, czuję się tak, jakbym sam(a) go doświadczał(a).', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Kiedy czuję zmianę w emocjach, mam tendencję do wymyślania nowych pomysłów.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Kiedy staję przed wyzwaniem, po prostu się poddaję, bo wierzę, że porażka jest nieunikniona.*', 'subscale' => 'own', 'is_reverse' => true],
            ['content' => 'Wiem, co czują inni ludzie, po prostu na nich patrząc.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Pomagam innym poczuć się lepiej, kiedy są przygnębieni.', 'subscale' => 'others', 'is_reverse' => false],
            ['content' => 'Używam dobrego nastroju, by pomóc sobie w zmaganiu się z przeszkodami.', 'subscale' => 'usage', 'is_reverse' => false],
            ['content' => 'Potrafię rozpoznać, co ludzie czują, słuchając tonu ich głosu.', 'subscale' => 'perception', 'is_reverse' => false],
            ['content' => 'Trudno mi zrozumieć, dlaczego ludzie czują się tak, jak się czują.*', 'subscale' => 'perception', 'is_reverse' => true],
        ];

        foreach ($sseitData as $s) {
            SseitQuestion::create($s);
        }
    }
}
