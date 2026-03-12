<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ExerciseOption extends Model {
    protected $fillable = ['exercise_id', 'text', 'is_correct', 'ideal_score'];
}
