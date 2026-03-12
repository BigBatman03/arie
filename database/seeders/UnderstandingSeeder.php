<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exercise;

class UnderstandingSeeder extends Seeder
{
    public function run()
    {
        $moduleId = 3;

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
                'module_id' => $moduleId,
                'type' => 'scenario_choice',
                'content' => $d['content'],
                'explanation' => $d['explanation']
            ]);
            $ex->options()->createMany($d['options']);
        }
    }
}
