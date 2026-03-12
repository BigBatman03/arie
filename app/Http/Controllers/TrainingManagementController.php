<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Exercise;
use App\Models\ActivityLog;
use App\Models\ModuleResult;
use Illuminate\Support\Facades\Auth;

class TrainingManagementController extends Controller
{
    public function index()
    {
        $module = Module::where('slug', 'management')->firstOrFail();

        // TODO: wynieść do Service/Presenter (formatowanie ćwiczeń do JS)
        $exercises = Exercise::where('module_id', $module->id)
            ->with('options')
            ->get()
            ->map(function ($ex) {
                return [
                    'title' => $ex->title,
                    'text' => $ex->content,
                    'explanation' => $ex->explanation,
                    'actions' => $ex->options->map(function ($opt) {
                        return [
                            'text' => $opt->text,
                            'ideal' => (int) $opt->ideal_score,
                        ];
                    })->values(), // kluczowe dla JS
                ];
            })
            ->values();

        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-zarzadzanie',
                'type' => 'visit',
                'meta_data' => 'Rozpoczęcie modułu'
            ]);
        }

        return view('training.management', compact('module', 'exercises'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer',
            'max_score' => 'required|integer'
        ]);

        if (Auth::check()) {
            $module = Module::firstOrCreate(['slug' => 'management'], ['name' => 'Zarządzanie emocjami']);

            ModuleResult::create([
                'user_id' => Auth::id(),
                'module_id' => $module->id,
                'score' => $validated['score'],
                'max_score' => $validated['max_score']
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-zarzadzanie',
                'type' => 'completion'
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
