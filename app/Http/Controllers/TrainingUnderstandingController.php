<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Exercise;
use App\Models\ActivityLog;
use App\Models\ModuleResult;
use Illuminate\Support\Facades\Auth;

class TrainingUnderstandingController extends Controller
{
    public function index()
    {
        $module = Module::where('slug', 'understanding')->firstOrFail();

        // TODO: wynieść do Service/Presenter (formatowanie ćwiczeń do JS)
        $exercises = Exercise::where('module_id', $module->id)
            ->with('options')
            ->inRandomOrder()
            ->get()
            ->map(function ($ex) {
                $options = $ex->options
                    ->map(fn($opt) => [
                        'text' => $opt->text,
                        'is_correct' => (int) $opt->is_correct,
                    ])
                    ->shuffle()
                    ->values(); // kluczowe dla JS

                return [
                    'text' => $ex->content,
                    'explanation' => $ex->explanation,
                    'options' => $options,
                ];
            })
            ->values(); // kluczowe dla JS

        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-rozumienie',
                'type' => 'visit',
                'meta_data' => 'Rozpoczęcie modułu'
            ]);
        }

        return view('training.understanding', compact('module', 'exercises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer',
            'max_score' => 'required|integer'
        ]);

        if (Auth::check()) {
            $module = Module::where('slug', 'understanding')->first();
            if ($module) {
                ModuleResult::create([
                    'user_id' => Auth::id(),
                    'module_id' => $module->id,
                    'score' => $validated['score'],
                    'max_score' => $validated['max_score']
                ]);

                ActivityLog::create([
                    'user_id' => Auth::id(),
                    'module' => 'trening-rozumienie',
                    'type' => 'completion',
                    'meta_data' => "Wynik: {$validated['score']}/{$validated['max_score']}"
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
