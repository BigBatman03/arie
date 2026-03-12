<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class ManagementSeeder extends Seeder
{
    public function run()
    {
        $moduleId = 4;

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
                'module_id' => $moduleId,
                'type' => 'scenario_scale',
                'title' => $m['title'],
                'content' => $m['content'],
                'explanation' => $m['explanation']
            ]);
            $ex->options()->createMany($m['options']);
        }
    }
}
