<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Module extends Model {
    // Moduły (słownikowe) w tym projekcie nie mają timestampu aktualizacji w definicji SQL
    const UPDATED_AT = null;
    
    protected $fillable = ['slug', 'name'];
    public function exercises() { return $this->hasMany(Exercise::class); }
    public function results() { return $this->hasMany(ModuleResult::class); }
}
