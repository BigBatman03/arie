<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SseitQuestion;
use App\Models\SseitResult;
use App\Models\ActivityLog; // Dodane
use Illuminate\Support\Facades\Auth;

class SseitController extends Controller
{
    public function index()
    {
        // Logowanie odwiedzin
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'test-sseit',
                'type' => 'visit',
                'meta_data' => 'Rozpoczęcie testu'
            ]);
        }

        $questions = SseitQuestion::all();
        return view('sseit', compact('questions'));
    }

    public function store(Request $request)
    {
        $data = $request->input('answers');

        if (!$data || !is_array($data)) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Brak odpowiedzi. Wypełnij wszystkie pola.'], 422);
            }
            return back()->with('error', 'Brak odpowiedzi. Wypełnij wszystkie pola.');
        }

        $questions = SseitQuestion::all()->keyBy('id');

        $scores = [
            'perception' => 0,
            'usage' => 0,
            'own' => 0,
            'others' => 0,
        ];

        $total = 0;

        foreach ($data as $qId => $val) {
            $val = (int)$val;
            
            if (!isset($questions[$qId])) continue;
            
            $q = $questions[$qId];

            // Obsługa pytań odwróconych (1->5, 5->1)
            $points = $q->is_reverse ? (6 - $val) : $val;

            // Zliczanie do podskal
            if (array_key_exists($q->subscale, $scores)) {
                $scores[$q->subscale] += $points;
            }
            
            $total += $points;
        }

        // Zapis wyniku
        $result = SseitResult::create([
            'user_id' => Auth::id(),
            'perception' => $scores['perception'],
            'use_emotions' => $scores['usage'],
            'manage_own' => $scores['own'],
            'manage_others' => $scores['others'],
            'total_score' => $total,
            'max_total' => $questions->count() * 5
        ]);

        // Logowanie ukończenia testu
        ActivityLog::create([
            'user_id' => Auth::id(),
            'module' => 'test-sseit',
            'type' => 'sseit_result', // lub 'completion'
            'meta_data' => "Wynik: $total"
        ]);

        // Jeśli żądanie jest AJAX / chce JSON (jak w nowym widoku sseit.blade.php)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Wynik zapisany',
                'results' => $result
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Test SSEIT zakończony pomyślnie!');
    }
}
