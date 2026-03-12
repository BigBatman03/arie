<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\ModuleResult;
use App\Models\ActivityLog;

class TrainingPerceptionController extends Controller
{
    public function index() {
        // Pobieramy moduł po slugu
        $module = Module::where('slug', 'perception')->first();
        
        // Jeśli nie ma modułu w bazie, zwracamy pustą tablicę (aby nie było błędu 500)
        if (!$module) {
            return view('training.perception', ['exercises' => []]);
        }

        // Pobieramy ćwiczenia LOSOWO (.inRandomOrder)
        // Ładujemy też opcje z bazy (.with('options'))
        $exercises = $module->exercises()
            ->with('options')
            ->inRandomOrder() // Losowa kolejność pytań
            ->get()
            ->map(function($ex) {
                // Znajdź poprawną odpowiedź z opcji (lub z configu jako fallback)
                $correctOption = $ex->options->firstWhere('is_correct', 1);
                $correctText = $correctOption ? $correctOption->text : ($ex->config['correct_text'] ?? '');

                // Pobieramy listę odpowiedzi z bazy i mieszamy je (shuffle)
                // Jeśli w bazie nie ma opcji (stara wersja bazy), fallback do pustej tablicy
                $options = $ex->options->isNotEmpty() 
                    ? $ex->options->pluck('text')->shuffle()->all()
                    : []; 

                // Zabezpieczenie na wypadek starej bazy - dodaj poprawne, jeśli lista pusta
                if (empty($options) && $correctText) {
                    $options = [$correctText];
                }

                return [
                    'type' => 'identify',
                    'image' => asset($ex->media_path), 
                    'question' => 'Jaką emocję widzisz?',
                    'options' => $options,
                    'correct' => $correctText
                ];
            });

        // Logowanie odwiedzin
        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-percepcja', // Musi pasować do tablicy w ProfileController
                'type' => 'visit',
                'meta_data' => 'Przeglądanie ćwiczeń'
            ]);
        }

        return view('training.perception', compact('exercises'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'score' => 'required|integer',
            'max_score' => 'required|integer'
        ]);

        if (Auth::check()) {
            $module = Module::firstOrCreate(['slug' => 'perception'], ['name' => 'Percepcja emocji']);

            ModuleResult::create([
                'user_id' => Auth::id(),
                'module_id' => $module->id,
                'score' => $validated['score'],
                'max_score' => $validated['max_score']
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-percepcja',
                'type' => 'completion'
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
