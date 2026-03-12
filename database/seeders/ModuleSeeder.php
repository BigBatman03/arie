<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Exercise;
use App\Models\ExerciseOption;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run()
    {
        // Disable FK checks to allow truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ExerciseOption::truncate();
        Exercise::truncate();
        Module::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. MODULES
        $modules = [
            ['id' => 1, 'slug' => 'perception', 'name' => 'Percepcja emocji'],
            ['id' => 2, 'slug' => 'usage', 'name' => 'Wykorzystanie emocji'],
            ['id' => 3, 'slug' => 'understanding', 'name' => 'Rozumienie emocji'],
            ['id' => 4, 'slug' => 'management', 'name' => 'Zarządzanie emocjami'],
            ['id' => 5, 'slug' => 'sseit', 'name' => 'Test Inteligencji Emocjonalnej (SSEIT)'],
        ];

        foreach ($modules as $m) {
            Module::create($m);
        }

        // =============================================
        // MODUŁ 1: PERCEPCJA (Przykłady - konwersja SQL)
        // =============================================
        
        // Helper to quick add perception
        $addPerception = function($path, $correct, $wrong1, $wrong2, $wrong3) {
            $ex = Exercise::create([
                'module_id' => 1,
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

        // ... SMUTEK ...
        $addPerception('photoemocje/sad1.jpg', 'Smutek', 'Złość', 'Wstręt', 'Strach');
        $addPerception('photoemocje/sad2.jpg', 'Smutek', 'Zaskoczenie', 'Radość', 'Wstręt');
        $addPerception('photoemocje/sad3.jpg', 'Smutek', 'Strach', 'Złość', 'Radość');
        $addPerception('photoemocje/sad4.jpg', 'Smutek', 'Wstręt', 'Zaskoczenie', 'Złość');
        $addPerception('photoemocje/sad5.jpg', 'Smutek', 'Strach', 'Radość', 'Złość');
        $addPerception('photoemocje/sad6.jpg', 'Smutek', 'Wstręt', 'Zaskoczenie', 'Strach');
        $addPerception('photoemocje/sad7.jpg', 'Smutek', 'Złość', 'Radość', 'Wstręt');

        // ... RADOŚĆ ...
        $addPerception('photoemocje/happy1.jpg', 'Radość', 'Zaskoczenie', 'Wstręt', 'Smutek');
        $addPerception('photoemocje/happy2.jpg', 'Radość', 'Złość', 'Strach', 'Smutek');
        $addPerception('photoemocje/happy3.jpg', 'Radość', 'Zaskoczenie', 'Wstręt', 'Strach');
        $addPerception('photoemocje/happy4.jpg', 'Radość', 'Smutek', 'Złość', 'Wstręt');
        $addPerception('photoemocje/happy5.jpg', 'Radość', 'Zaskoczenie', 'Strach', 'Wstręt');
        $addPerception('photoemocje/happy6.jpg', 'Radość', 'Złość', 'Smutek', 'Strach');
        $addPerception('photoemocje/happy7.jpg', 'Radość', 'Wstręt', 'Zaskoczenie', 'Złość');

        // ... ZŁOŚĆ ...
        $addPerception('photoemocje/angry1.jpg', 'Złość', 'Wstręt', 'Strach', 'Smutek');
        $addPerception('photoemocje/angry2.jpg', 'Złość', 'Zaskoczenie', 'Radość', 'Wstręt');
        $addPerception('photoemocje/angry3.jpg', 'Złość', 'Strach', 'Smutek', 'Zaskoczenie');
        $addPerception('photoemocje/angry4.jpg', 'Złość', 'Wstręt', 'Zaskoczenie', 'Strach');
        $addPerception('photoemocje/angry5.jpg', 'Złość', 'Smutek', 'Radość', 'Strach');
        $addPerception('photoemocje/angry6.jpg', 'Złość', 'Wstręt', 'Zaskoczenie', 'Smutek');
        $addPerception('photoemocje/angry7.jpg', 'Złość', 'Strach', 'Zaskoczenie', 'Radość');

        // ... STRACH ...
        $addPerception('photoemocje/scared1.jpg', 'Strach', 'Zaskoczenie', 'Smutek', 'Wstręt');
        $addPerception('photoemocje/scared2.jpg', 'Strach', 'Złość', 'Zaskoczenie', 'Radość');
        $addPerception('photoemocje/scared3.jpg', 'Strach', 'Wstręt', 'Smutek', 'Złość');
        $addPerception('photoemocje/scared4.jpg', 'Strach', 'Zaskoczenie', 'Wstręt', 'Radość');

        // ... WSTRĘT ...
        $addPerception('photoemocje/disgusted1.jpg', 'Wstręt', 'Złość', 'Strach', 'Smutek');
        $addPerception('photoemocje/disgusted2.jpg', 'Wstręt', 'Zaskoczenie', 'Złość', 'Strach');
        $addPerception('photoemocje/disgusted3.jpg', 'Wstręt', 'Smutek', 'Złość', 'Radość');
        $addPerception('photoemocje/disgusted4.jpg', 'Wstręt', 'Strach', 'Zaskoczenie', 'Złość');

        // ... ZSKOCZENIE ...
        $addPerception('photoemocje/surprised1.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Wstręt');
        $addPerception('photoemocje/surprised2.jpg', 'Zaskoczenie', 'Radość', 'Strach', 'Złość');
        $addPerception('photoemocje/surprised3.jpg', 'Zaskoczenie', 'Złość', 'Smutek', 'Wstręt');
        $addPerception('photoemocje/surprised4.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Smutek');
        $addPerception('photoemocje/surprised5.jpg', 'Zaskoczenie', 'Wstręt', 'Smutek', 'Złość');
        $addPerception('photoemocje/surprised6.jpg', 'Zaskoczenie', 'Strach', 'Radość', 'Wstręt');
        $addPerception('photoemocje/surprised7.jpg', 'Zaskoczenie', 'Radość', 'Smutek', 'Złość');

        // =============================================
        // MODUŁ 2: WYKORZYSTANIE (Scenariusze)
        // =============================================
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
                'module_id' => 2,
                'type' => 'scenario_scale',
                'title' => $u['title'],
                'content' => $u['content'],
                'explanation' => $u['explanation']
            ]);
            $ex->options()->createMany($u['options']);
        }


        // =============================================
        // MODUŁ 3: ROZUMIENIE
        // =============================================
        $undData = [
            [
                'content' => 'Marek dowiedział się, że jego projekt został odrzucony przez klienta po miesiącu ciężkiej pracy. Czuje, że jego wysiłek poszedł na marne, a cel został zablokowany.',
                'explanation' => 'Frustracja pojawia się, gdy dążenie do celu zostaje zablokowane mimo wysiłku.',
                'options' => [['text'=>'Strach','is_correct'=>0], ['text'=>'Wstręt','is_correct'=>0], ['text'=>'Frustracja','is_correct'=>1], ['text'=>'Wstyd','is_correct'=>0]]
            ],
            [
                'content' => 'Anna widzi, jak jej koleżanka z pracy, z którą rywalizuje o awans, dostaje pochwałę od szefa. Anna czuje ukłucie w sercu i pragnie, by to ona była na jej miejscu.',
                'explanation' => 'Zawiść to pragnienie posiadania tego, co ma ktoś inny (często połączone z niechęcią). Zazdrość dotyczy zagrożenia relacji.',
                'options' => [['text'=>'Zazdrość','is_correct'=>0], ['text'=>'Zawiść','is_correct'=>1], ['text'=>'Podziw','is_correct'=>0], ['text'=>'Złość','is_correct'=>0]]
            ],
            [
                'content' => 'Piotr zapomniał o rocznicy ślubu. Widząc smutek żony, czuje ciężar w klatce piersiowej i ma wyrzuty sumienia, że naruszył własne standardy bycia dobrym mężem.',
                'explanation' => 'Poczucie winy dotyczy konkretnego zachowania naruszającego normy ("zrobiłem coś złego"). Wstyd dotyczy całej osoby ("jestem zły").',
                'options' => [['text'=>'Wstyd','is_correct'=>0], ['text'=>'Poczucie winy','is_correct'=>1], ['text'=>'Lęk','is_correct'=>0], ['text'=>'Zażenowanie','is_correct'=>0]]
            ],
            [
                'content' => 'Kasia idzie ciemną uliczką i słyszy za sobą szybkie kroki. Jej serce bije szybciej, mięśnie się napinają, jest gotowa do biegu.',
                'explanation' => 'Strach to reakcja na bezpośrednie zagrożenie fizyczne lub psychiczne, mobilizująca do ucieczki lub walki.',
                'options' => [['text'=>'Złość','is_correct'=>0], ['text'=>'Strach','is_correct'=>1], ['text'=>'Zaskoczenie','is_correct'=>0], ['text'=>'Ekscytacja','is_correct'=>0]]
            ],
            [
                'content' => 'Tomek wygłosił prezentację, ale pomylił slajdy. Wszyscy zaczęli się śmiać. Tomek spuścił wzrok, poczuł gorąco na twarzy i chciał zapaść się pod ziemię.',
                'explanation' => 'Wstyd wiąże się z poczuciem publicznej ekspozycji, bycia ocenianym negatywnie i chęcią zniknięcia.',
                'options' => [['text'=>'Poczucie winy','is_correct'=>0], ['text'=>'Wstyd','is_correct'=>1], ['text'=>'Smutek','is_correct'=>0], ['text'=>'Rozczarowanie','is_correct'=>0]]
            ],
            [
                'content' => 'Ewa żegna się z synem, który wyjeżdża na studia za granicę. Cieszy się z jego sukcesu, ale jednocześnie ma łzy w oczach, bo będzie za nim tęsknić.',
                'explanation' => 'To emocja mieszana zawierająca radość (sukces syna) i smutek (rozstanie/strata).',
                'options' => [['text'=>'Czysta Radość','is_correct'=>0], ['text'=>'Sentymentalizm','is_correct'=>0], ['text'=>'Nostalgia / Słodko-gorzkie uczucie','is_correct'=>1], ['text'=>'Rozpacz','is_correct'=>0]]
            ],
            [
                'content' => 'Jan czeka na wyniki ważnych badań lekarskich, które będą jutro. Nie może się skupić, ciągle myśli o najgorszym scenariuszu, czuje niepokój w żołądku.',
                'explanation' => 'Lęk dotyczy nieokreślonego lub przyszłego zagrożenia ("co jeśli?"). Strach dotyczy zagrożenia tu i teraz.',
                'options' => [['text'=>'Strach','is_correct'=>0], ['text'=>'Lęk / Niepokój','is_correct'=>1], ['text'=>'Smutek','is_correct'=>0], ['text'=>'Panika','is_correct'=>0]]
            ],
            [
                'content' => 'Monika dowiedziała się, że jej partner potajemnie spotyka się z jej byłą przyjaciółką. Czuje się zagrożona utratą relacji w wyniku działania osoby trzeciej.',
                'explanation' => 'Zazdrość pojawia się, gdy cenna relacja jest zagrożona przez osobę trzecią. (Zawiść dotyczy dóbr/cech).',
                'options' => [['text'=>'Zawiść','is_correct'=>0], ['text'=>'Zazdrość','is_correct'=>1], ['text'=>'Wstręt','is_correct'=>0], ['text'=>'Smutek','is_correct'=>0]]
            ],
            [
                'content' => 'Pracownik otrzymał nagrodę, na którą bardzo ciężko pracował przez rok. Czuje, że jego kompetencje zostały docenione, unosi głowę wysoko.',
                'explanation' => 'Duma jest pozytywną emocją wynikającą z osiągnięcia celu, który przypisujemy własnym staraniom.',
                'options' => [['text'=>'Pycha','is_correct'=>0], ['text'=>'Duma','is_correct'=>1], ['text'=>'Ulga','is_correct'=>0], ['text'=>'Wdzięczność','is_correct'=>0]]
            ],
            [
                'content' => 'Karol wszedł do kuchni i poczuł zapach zepsutego mięsa. Odruchowo zmarszczył nos i cofnął się.',
                'explanation' => 'Wstręt to podstawowa reakcja na bodźce trujące, niehigieniczne lub moralnie odpychające.',
                'options' => [['text'=>'Gniew','is_correct'=>0], ['text'=>'Wstręt','is_correct'=>1], ['text'=>'Strach','is_correct'=>0], ['text'=>'Zaskoczenie','is_correct'=>0]]
            ],
            [
                'content' => 'Marta dowiedziała się, że kolega z zespołu przypisał sobie zasługi za jej raport. Uważa to za skrajnie niesprawiedliwe i ma ochotę na konfrontację.',
                'explanation' => 'Gniew jest reakcją na przeszkodę, atak lub naruszenie zasad/sprawiedliwości.',
                'options' => [['text'=>'Gniew / Oburzenie','is_correct'=>1], ['text'=>'Smutek','is_correct'=>0], ['text'=>'Rozczarowanie','is_correct'=>0], ['text'=>'Zazdrość','is_correct'=>0]]
            ],
            [
                'content' => 'Adam skończył trudny egzamin, którego bardzo się bał. Okazało się, że zdał. Napięcie opadło, oddycha głęboko i czuje lekkość.',
                'explanation' => 'Ulga to pozytywny stan następujący po ustaniu zagrożenia lub stresu.',
                'options' => [['text'=>'Radość','is_correct'=>0], ['text'=>'Duma','is_correct'=>0], ['text'=>'Ulga','is_correct'=>1], ['text'=>'Ekscytacja','is_correct'=>0]]
            ],
            [
                'content' => 'Zofia patrzy na zachowanie polityka, którego uważa za niemoralnego i "mniejszego" niż ona. Czuje wyższość i niechęć.',
                'explanation' => 'Pogarda to mieszanka wstrętu i gniewu, zawierająca element poczucia wyższości nad obiektem.',
                'options' => [['text'=>'Gniew','is_correct'=>0], ['text'=>'Pogarda','is_correct'=>1], ['text'=>'Złość','is_correct'=>0], ['text'=>'Wstręt','is_correct'=>0]]
            ],
            [
                'content' => 'Krzysztof otrzymał bezinteresowną pomoc od sąsiada w naprawie samochodu. Czuje ciepło i chęć odwdzięczenia się.',
                'explanation' => 'Wdzięczność pojawia się w odpowiedzi na otrzymane dobro, które postrzegamy jako celowe i kosztowne dla dawcy.',
                'options' => [['text'=>'Podziw','is_correct'=>0], ['text'=>'Sympatia','is_correct'=>0], ['text'=>'Wdzięczność','is_correct'=>1], ['text'=>'Duma','is_correct'=>0]]
            ],
            [
                'content' => 'Jadąc na rollercoasterze, Magda krzyczy. Boi się wysokości, ale jednocześnie czerpie z tego przyjemność i czuje przypływ adrenaliny.',
                'explanation' => 'Ekscytacja tego typu (thrill) to mieszanka strachu i radości/przyjemności w kontrolowanych warunkach.',
                'options' => [['text'=>'Panika','is_correct'=>0], ['text'=>'Groza','is_correct'=>0], ['text'=>'Ekscytacja (Thrill)','is_correct'=>1], ['text'=>'Euforia','is_correct'=>0]]
            ],
            [
                'content' => 'Damian stracił ukochanego psa. Czuje pustkę, brak energii, wycofuje się z kontaktów z ludźmi.',
                'explanation' => 'Smutek jest reakcją na nieodwracalną stratę. Jego funkcją jest asymilacja straty i regeneracja.',
                'options' => [['text'=>'Depresja','is_correct'=>0], ['text'=>'Smutek / Żałoba','is_correct'=>1], ['text'=>'Lęk','is_correct'=>0], ['text'=>'Apatia','is_correct'=>0]]
            ],
            [
                'content' => 'Wchodząc do domu, Ola zobaczyła przyjęcie niespodziankę. Otworzyła szeroko oczy i usta, zatrzymała się w bezruchu na sekundę.',
                'explanation' => 'Zaskoczenie to krótka emocja reagująca na nagłe, nieoczekiwane zdarzenie, resetująca uwagę.',
                'options' => [['text'=>'Strach','is_correct'=>0], ['text'=>'Radość','is_correct'=>0], ['text'=>'Zaskoczenie','is_correct'=>1], ['text'=>'Zmieszanie','is_correct'=>0]]
            ],
            [
                'content' => 'Wiktor patrzy na mistrza szachowego z ogromnym szacunkiem, uznając jego wyższość intelektualną i chcąc być taki jak on.',
                'explanation' => 'Podziw to pozytywna reakcja na czyjąś doskonałość lub wybitne umiejętności.',
                'options' => [['text'=>'Zazdrość','is_correct'=>0], ['text'=>'Podziw','is_correct'=>1], ['text'=>'Sympatia','is_correct'=>0], ['text'=>'Zauroczenie','is_correct'=>0]]
            ],
            [
                'content' => 'Po kłótni z przyjacielem, Michał czuje się źle. Chce naprawić relację, ale jednocześnie boi się odrzucenia.',
                'explanation' => 'To stan mieszany łączący poczucie winy (chęć naprawy) z lękiem o więź.',
                'options' => [['text'=>'Złość','is_correct'=>0], ['text'=>'Skrucha / Niepokój','is_correct'=>1], ['text'=>'Obojętność','is_correct'=>0], ['text'=>'Wstręt','is_correct'=>0]]
            ],
            [
                'content' => 'Daria została publicznie oskarżona o coś, czego nie zrobiła. Czuje bezsilność połączoną z silnym poczuciem krzywdy.',
                'explanation' => 'Rozżalenie to mieszanka smutku i gniewu wynikająca z poczucia bycia ofiarą niesprawiedliwości, często z elementem bezsilności.',
                'options' => [['text'=>'Rozżalenie','is_correct'=>1], ['text'=>'Wstyd','is_correct'=>0], ['text'=>'Poczucie winy','is_correct'=>0], ['text'=>'Zazdrość','is_correct'=>0]]
            ],
        ];

        foreach ($undData as $d) {
            $ex = Exercise::create([
                'module_id' => 3,
                'type' => 'scenario_choice',
                'content' => $d['content'],
                'explanation' => $d['explanation']
            ]);
            $ex->options()->createMany($d['options']);
        }


        // =============================================
        // MODUŁ 4: ZARZĄDZANIE
        // =============================================
        $mgmtData = [
            [
                'title' => 'Sytuacja 1: Krytyka publiczna',
                'content' => 'Podczas ważnego zebrania Twój przełożony wytyka Ci błąd w raporcie przy całym zespole. Czujesz napływ złości i wstyd.',
                'explanation' => 'Agresja (1) eskaluje konflikt. Tłumienie (2) prowadzi do stresu. Opanowanie emocji i danie sobie czasu na reakcję (5) jest najbardziej dojrzałe.',
                'options' => [
                    ['text'=>'Natychmiast przerywasz szefowi i agresywnie tłumaczysz, że to nie Twoja wina.', 'ideal_score'=>1],
                    ['text'=>'Milczysz i dusisz złość w sobie, planując zemstę lub obgadanie szefa później.', 'ideal_score'=>2],
                    ['text'=>'Przyjmujesz informację na chłodno („Sprawdzę to”), a po zebraniu idziesz na krótki spacer, by ochłonąć przed analizą błędu.', 'ideal_score'=>5],
                    ['text'=>'Obracasz sytuację w żart, umniejszając znaczenie swojej pracy, by rozładować napięcie.', 'ideal_score'=>3],
                ]
            ],
            [
                'title' => 'Sytuacja 2: Paraliż przed wystąpieniem',
                'content' => 'Za godzinę masz wygłosić prezentację przed zarządem. Czujesz paraliżujący lęk, serce Ci wali, masz pustkę w głowie.',
                'explanation' => 'Kofeina (2) przy lęku tylko pogarsza objawy fizyczne. Katastrofizowanie (1) nasila lęk. Techniki oddechowe (5) fizjologicznie redukują stres.',
                'options' => [
                    ['text'=>'Powtarzasz sobie w kółko: „Na pewno się zbłaźnię”, wizualizując porażkę.', 'ideal_score'=>1],
                    ['text'=>'Wypijasz dwie mocne kawy, by pobudzić się do myślenia.', 'ideal_score'=>2],
                    ['text'=>'Stosujesz technikę głębokiego oddychania (4 sekundy wdech, 6 wydech) i przeglądasz tylko kluczowe punkty.', 'ideal_score'=>5],
                    ['text'=>'Dzwonisz do partnera/ki, by ponarzekać, jak bardzo nienawidzisz tej pracy.', 'ideal_score'=>2],
                ]
            ],
            [
                'title' => 'Sytuacja 3: Euforia po sukcesie',
                'content' => 'Właśnie dowiedziałeś się, że wygrałeś duży przetarg. Jesteś w euforii i czujesz się niezwyciężony.',
                'explanation' => 'Zarządzanie emocjami to też zarządzanie euforią. Silna radość sprzyja podejmowaniu ryzykownych zobowiązań (1). Najlepiej cieszyć się, ale decyzje podejmować "na trzeźwo" (5).',
                'options' => [
                    ['text'=>'Natychmiast dzwonisz do klienta i obiecujesz, że zrobicie projekt w połowę krótszym czasie.', 'ideal_score'=>1],
                    ['text'=>'Świętujesz z zespołem, pozwalając sobie na radość, ale decyzje o harmonogramie zostawiasz na kolejny dzień.', 'ideal_score'=>5],
                    ['text'=>'Ignorujesz radość i od razu szukasz „haczyków” w umowie, by nie zapeszyć.', 'ideal_score'=>3],
                    ['text'=>'Kupujesz wszystkim drogie prezenty z własnych oszczędności.', 'ideal_score'=>2],
                ]
            ],
            [
                'title' => 'Sytuacja 4: Konflikt wartości',
                'content' => 'Przyjaciel prosi Cię o kłamstwo w jego imieniu, co jest niezgodne z Twoimi zasadami. Czujesz dyskomfort i poczucie winy.',
                'explanation' => 'Asertywność (5) pozwala zadbać o własne granice bez niszczenia relacji. Uległość (2, 3) rodzi negatywne emocje długofalowe.',
                'options' => [
                    ['text'=>'Zgadzasz się dla „świętego spokoju”, ale potem unikasz kontaktu z przyjacielem.', 'ideal_score'=>2],
                    ['text'=>'Odmawiasz, wyjaśniając spokojnie, że cenisz przyjaźń, ale to kłamstwo jest dla Ciebie nieakceptowalne.', 'ideal_score'=>5],
                    ['text'=>'Kłamiesz, a potem dręczysz się wyrzutami sumienia przez tygodnie.', 'ideal_score'=>1],
                    ['text'=>'Zrywasz znajomość bez słowa wyjaśnienia.', 'ideal_score'=>1],
                ]
            ],
            [
                'title' => 'Sytuacja 5: Niepowodzenie projektu',
                'content' => 'Projekt, który prowadziłeś, został anulowany z przyczyn budżetowych. Czujesz rozczarowanie i smutek.',
                'explanation' => 'Przeżycie smutku (akceptacja) jest konieczne do adaptacji (5). Udawanie (2) blokuje przetwarzanie emocji, a obwinianie (1) psuje reputację.',
                'options' => [
                    ['text'=>'Udajesz przed wszystkimi, że w ogóle Cię to nie obchodzi (maska obojętności).', 'ideal_score'=>2],
                    ['text'=>'Pozwalasz sobie na jeden wieczór smutku, rozmawiasz z bliską osobą, a potem szukasz nowych możliwości.', 'ideal_score'=>5],
                    ['text'=>'Rozpamiętujesz to przez miesiąc, analizując, co mogłeś zrobić lepiej (ruminacja).', 'ideal_score'=>2],
                    ['text'=>'Obwiniasz dział finansowy publicznie o niekompetencję.', 'ideal_score'=>1],
                ]
            ],
        ];

        foreach ($mgmtData as $m) {
            $ex = Exercise::create([
                'module_id' => 4,
                'type' => 'scenario_scale',
                'title' => $m['title'],
                'content' => $m['content'],
                'explanation' => $m['explanation']
            ]);
            $ex->options()->createMany($m['options']);
        }


        // =============================================
        // MODUŁ 5: SSEIT
        // =============================================
        $sseitData = [
            ['content' => 'Wiem, kiedy mówić innym o moich problemach osobistych.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Kiedy napotykam przeszkody, przypominam sobie sytuacje, w których podobne trudności udało mi się pokonać.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Spodziewam się, że większość spraw potoczy się po mojej myśli.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Inni ludzie łatwo mi się zwierzają.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Trudno mi zrozumieć komunikaty niewerbalne innych ludzi.*', 'config' => ['subscale' => 'perception', 'reverse' => true]],
            ['content' => 'Niektóre z najważniejszych wydarzeń w moim życiu skłoniły mnie do ponownej oceny tego, co jest ważne, a co nieważne.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Kiedy zmienia się mój nastrój, widzę nowe możliwości.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Emocje są jedną z rzeczy, dzięki którym warto żyć.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Jestem świadomy własnych emocji, kiedy ich doświadczam.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Spodziewam się, że wydarzą się dobre rzeczy.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Lubię dzielić się swoimi emocjami z innymi.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Kiedy odczuwam pozytywne emocje, wiem jak sprawić, by trwały długo.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Aranżuję wydarzenia sprawiające innym radość.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Szukam zajęć, które mnie uszczęśliwiają.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Jestem świadomy przekazu niewerbalnego, który wysyłam innym.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Prezentuję się w sposób, który robi dobre wrażenie na innych', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Kiedy jestem w dobrym nastroju, rozwiązywanie problemów jest dla mnie proste.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Potrafię rozpoznać emocje innych ludzi patrząc na mimikę ich twarzy.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Wiem, dlaczego moje emocje ulegają zmianie.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Kiedy jestem w dobrym nastroju, potrafię wymyślić wiele nowych pomysłów.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Mam kontrolę nad swoimi emocjami.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Łatwo rozpoznaję emocje innych.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Motywuję się, wyobrażając sobie dobry wynik działań, które podejmuję.', 'config' => ['subscale' => 'own', 'reverse' => false]],
            ['content' => 'Komplementuję innych, kiedy robią coś dobrze.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Jestem świadomy przekazu niewerbalnego innych ludzi.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Kiedy inna osoba mówi mi o ważnym wydarzeniu w swoim życiu, czuję się tak, jakbym sam(a) go doświadczał(a).', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Kiedy czuję zmianę w emocjach, mam tendencję do wymyślania nowych pomysłów.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Kiedy staję przed wyzwaniem, po prostu się poddaję, bo wierzę, że porażka jest nieunikniona.*', 'config' => ['subscale' => 'own', 'reverse' => true]],
            ['content' => 'Wiem, co czują inni ludzie, po prostu na nich patrząc.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Pomagam innym poczuć się lepiej, kiedy są przygnębieni.', 'config' => ['subscale' => 'others', 'reverse' => false]],
            ['content' => 'Używam dobrego nastroju, by pomóc sobie w zmaganiu się z przeszkodami.', 'config' => ['subscale' => 'usage', 'reverse' => false]],
            ['content' => 'Potrafię rozpoznać, co ludzie czują, słuchając tonu ich głosu.', 'config' => ['subscale' => 'perception', 'reverse' => false]],
            ['content' => 'Trudno mi zrozumieć, dlaczego ludzie czują się tak, jak się czują.*', 'config' => ['subscale' => 'perception', 'reverse' => true]],
        ];

        foreach ($sseitData as $s) {
            Exercise::create([
                'module_id' => 5,
                'type' => 'scenario_scale',
                'content' => $s['content'],
                'config' => $s['config']
            ]);
        }
    }
}
