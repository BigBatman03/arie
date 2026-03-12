<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
// use App\Models\Exercise; // <-- niepotrzebne po uproszczeniu index()
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\ModuleResult;

class TrainingUsageController extends Controller
{
    public function index()
    {
        $module = Module::where('slug', 'usage')->firstOrFail();

        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-wykorzystanie',
                'type' => 'visit',
                'meta_data' => 'Rozpoczęcie modułu'
            ]);
        }

        // TODO: wynieść do Service/Presenter (formatowanie ćwiczeń do JS)
        $exercises = $module->exercises()->with('options')->get()->map(function($ex) {
            return [
                'title' => $ex->title,
                'text' => $ex->content,
                'explanation' => $ex->explanation,
                'emotions' => $ex->options->map(function($opt) {
                    return [
                        'name' => $opt->text,
                        'ideal' => (int) $opt->ideal_score
                    ];
                })->values()
            ];
        })->values();

        return view('training.usage', compact('module', 'exercises'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'score' => 'required|integer',
            'max_score' => 'required|integer'
        ]);

        if (Auth::check()) {
            $module = Module::firstOrCreate(['slug' => 'usage'], ['name' => 'Wykorzystanie emocji']);

            ModuleResult::create([
                'user_id' => Auth::id(),
                'module_id' => $module->id,
                'score' => $validated['score'],
                'max_score' => $validated['max_score']
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-wykorzystanie',
                'type' => 'completion'
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
