<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class UsageSeeder extends Seeder
{
    public function run()
    {
        $moduleId = 2;
        
        $usageData = [
            [
                'title' => 'Korekta raportu finansowego',
                'content' => 'Musisz znaleźć drobne błędy i literówki w gęstym, skomplikowanym raporcie. Wymagana jest precyzja i dbałość o szczegóły.',
                'explanation' => 'Badania pokazują, że lekki smutek lub nastrój neutralny sprzyja analitycznemu myśleniu (focus on details), podczas gdy radość sprzyja patrzeniu na ogół (big picture).',
                'options' => [
                    ['text' => 'Lekki Smutek', 'ideal_score' => 5],
                    ['text' => 'Radość / Euforia', 'ideal_score' => 2],
                    ['text' => 'Złość', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Burza mózgów (Brainstorming)',
                'content' => 'Twój zespół musi wymyślić jak najwięcej nowych, nietypowych pomysłów na kampanię reklamową. Liczy się ilość i kreatywność.',
                'explanation' => 'Pozytywny nastrój (radość) rozszerza perspektywę poznawczą i zwiększa płynność generowania skojarzeń, co jest kluczowe w fazie kreatywnej.',
                'options' => [
                    ['text' => 'Radość', 'ideal_score' => 5],
                    ['text' => 'Lęk', 'ideal_score' => 1],
                    ['text' => 'Smutek', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Negocjacje o podwyżkę',
                'content' => 'Idziesz do szefa prosić o podwyżkę, na którą zasłużyłeś. Szef jest twardym negocjatorem.',
                'explanation' => 'Pewność siebie, a nawet odrobina złości (asertywność), pomaga w konfrontacji. Lęk i wstyd stawiają Cię w pozycji uległej.',
                'options' => [
                    ['text' => 'Pewność siebie / Lekka Złość', 'ideal_score' => 5],
                    ['text' => 'Lęk', 'ideal_score' => 1],
                    ['text' => 'Wstyd', 'ideal_score' => 1],
                ]
            ],
            [
                'title' => 'Planowanie inwestycji oszczędności życia',
                'content' => 'Decydujesz, gdzie ulokować wszystkie swoje oszczędności. Rynek jest ryzykowny.',
                'explanation' => 'Lęk (w umiarkowanym stopniu) działa tu jako system ostrzegawczy, zmuszając do ostrożności i weryfikacji ryzyka. Euforia może prowadzić do lekkomyślnych decyzji.',
                'options' => [
                    ['text' => 'Lęk / Ostrożność', 'ideal_score' => 4],
                    ['text' => 'Euforia', 'ideal_score' => 1],
                    ['text' => 'Złość', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Walka fizyczna / Zagrożenie',
                'content' => 'Zostałeś fizycznie zaatakowany na ulicy i musisz się bronić.',
                'explanation' => 'Silne emocje pobudzające (strach, złość) przekierowują krew do mięśni i mobilizują organizm do reakcji "walcz lub uciekaj". Spokój jest tu niewskazany.',
                'options' => [
                    ['text' => 'Strach / Mobilizacja', 'ideal_score' => 5],
                    ['text' => 'Złość', 'ideal_score' => 5],
                    ['text' => 'Relaks / Spokój', 'ideal_score' => 1],
                ]
            ],
             [
                'title' => 'Wspieranie przyjaciela w żałobie',
                'content' => 'Twój przyjaciel stracił kogoś bliskiego i płacze. Siedzisz z nim.',
                'explanation' => 'Dzielenie emocji (rezonans) jest kluczowe dla empatii. Radość w tej sytuacji byłaby odebrana jako brak zrozumienia i taktu.',
                'options' => [
                    ['text' => 'Smutek / Empatia', 'ideal_score' => 5],
                    ['text' => 'Radość', 'ideal_score' => 1],
                    ['text' => 'Złość', 'ideal_score' => 1],
                ]
            ],
            [
                'title' => 'Wykrywanie kłamstwa',
                'content' => 'Przesłuchujesz osobę podejrzaną o kradzież w firmie. Musisz ocenić, czy mówi prawdę.',
                'explanation' => 'Osoby w nastroju negatywnym/sceptycznym rzadziej dają się oszukać, ponieważ analizują komunikaty bardziej krytycznie niż osoby radosne.',
                'options' => [
                    ['text' => 'Sceptycyzm / Nieufność', 'ideal_score' => 5],
                    ['text' => 'Radość / Zaufanie', 'ideal_score' => 1],
                    ['text' => 'Litość', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Motywowanie zespołu do wysiłku',
                'content' => 'Jesteś trenerem sportowym w przerwie meczu. Twoja drużyna przegrywa, ale ma szansę wygrać.',
                'explanation' => 'Emocje są zaraźliwe. Lider musi promieniować energią (entuzjazmem lub mobilizującą złością), aby podnieść poziom energii w grupie.',
                'options' => [
                    ['text' => 'Entuzjazm / Złość sportowa', 'ideal_score' => 5],
                    ['text' => 'Rezygnacja / Smutek', 'ideal_score' => 1],
                    ['text' => 'Strach', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Pisanie listu reklamacyjnego',
                'content' => 'Kupiłeś drogi sprzęt, który się zepsuł po tygodniu, a sklep odmawia naprawy.',
                'explanation' => 'Złość jest emocją, która motywuje do walki o sprawiedliwość i usuwania przeszkód. Pomaga sformułować stanowcze żądania.',
                'options' => [
                    ['text' => 'Złość', 'ideal_score' => 5],
                    ['text' => 'Wdzięczność', 'ideal_score' => 1],
                    ['text' => 'Wstyd', 'ideal_score' => 2],
                ]
            ],
            [
                'title' => 'Rozwiązywanie konfliktu między dziećmi',
                'content' => 'Jako rodzic/nauczyciel musisz pogodzić dwójkę kłócących się dzieci.',
                'explanation' => 'Aby zarządzać emocjami innych (regulacja), sam musisz zachować spokój. Twoja złość tylko dolałaby oliwy do ognia.',
                'options' => [
                    ['text' => 'Spokój', 'ideal_score' => 5],
                    ['text' => 'Złość', 'ideal_score' => 2],
                    ['text' => 'Histeria', 'ideal_score' => 1],
                ]
            ],
        ];

        foreach ($usageData as $u) {
            $ex = Exercise::create([
                'module_id' => $moduleId,
                'type' => 'scenario_scale',
                'title' => $u['title'],
                'content' => $u['content'],
                'explanation' => $u['explanation']
            ]);
            $ex->options()->createMany($u['options']);
        }
    }
}
