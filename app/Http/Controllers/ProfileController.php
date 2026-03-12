<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModuleResult;
use App\Models\SseitResult;
use App\Models\ActivityLog;

class ProfileController extends Controller
{
    public function index()
    {
        // Sprawdzenie czy użytkownik jest zalogowany
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Musisz być zalogowany, aby zobaczyć swój profil.');
        }

        $user = Auth::user();

        // 1. Przygotuj strukturę postępu dla widoku
        $slugs = ['perception', 'usage', 'understanding', 'management'];
        $progress = [];

        foreach ($slugs as $slug) {
            // Pobieramy wyniki dla danego modułu (szukając po slugu w relacji module)
            $results = ModuleResult::where('user_id', $user->id)
                ->whereHas('module', function($q) use ($slug) {
                    $q->where('slug', $slug);
                })->get();

            $count = $results->count();
            // Obliczamy średni procent wyniku (lub ostatni, zależnie od logiki - tu weźmy max)
            $maxPercentage = 0;
            if ($count > 0) {
                foreach ($results as $res) {
                    $perc = ($res->max_score > 0) ? ($res->score / $res->max_score) * 100 : 0;
                    if ($perc > $maxPercentage) $maxPercentage = $perc;
                }
            }

            $progress[$slug] = [
                'count' => $count,
                'percentage' => round($maxPercentage)
            ];
        }

        // 2. Dane SSEIT
        $lastSseit = SseitResult::where('user_id', $user->id)->latest()->first();
        $sseitCount = SseitResult::where('user_id', $user->id)->count();

        // 3. Aktywności (filtrowanie tylko treningów i testów)
        $trainingModules = [
            'perception', 'usage', 'understanding', 'management', 'sseit',
            'trening-percepcja', 'trening-wykorzystanie', 'trening-rozumienie', 'trening-zarzadzanie', 'test-sseit'
        ];

        $activities = ActivityLog::where('user_id', $user->id)
            ->whereIn('module', $trainingModules)
            ->latest()
            ->limit(20)
            ->get();

        $lastWeekActivityCount = ActivityLog::where('user_id', $user->id)
            ->whereIn('module', $trainingModules)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();


        return view('profile', compact('user', 'progress', 'lastSseit', 'sseitCount', 'activities', 'lastWeekActivityCount'));
    }
}
