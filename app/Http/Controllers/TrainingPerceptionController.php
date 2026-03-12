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
        $module = Module::where('slug', 'perception')->first();

        if (!$module) {
            return view('training.perception', ['exercises' => []]);
        }

        $exercises = $module->exercises()
            ->with('options')
            ->inRandomOrder()
            ->get()
            ->map(function($ex) {
                $correctOption = $ex->options->firstWhere('is_correct', 1);
                $correctText = $correctOption ? $correctOption->text : ($ex->config['correct_text'] ?? '');

                $options = $ex->options->isNotEmpty()
                    ? $ex->options->pluck('text')->shuffle()->all()
                    : [];

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

        if (Auth::check()) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'module' => 'trening-percepcja',
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
