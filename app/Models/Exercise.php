<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {
    protected $fillable = ['module_id', 'type', 'title', 'content', 'media_path', 'explanation', 'config'];
    protected $casts = ['config' => 'array'];
    
    public function options() { return $this->hasMany(ExerciseOption::class); }
    public function module() { return $this->belongsTo(Module::class); }
}
