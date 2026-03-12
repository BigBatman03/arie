<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SseitResult extends Model {
    use HasFactory;

    // Wyniki testów są tylko zapisywane, nie edytowane
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'perception',
        'use_emotions',
        'manage_own',
        'manage_others',
        'total_score',
        'max_total'
    ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
