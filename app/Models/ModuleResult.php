<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ModuleResult extends Model {
    protected $fillable = ['user_id', 'module_id', 'score', 'max_score', 'completed_at'];
    public $timestamps = false;
    protected $dates = ['completed_at'];

    public function module() { return $this->belongsTo(Module::class); }
}
