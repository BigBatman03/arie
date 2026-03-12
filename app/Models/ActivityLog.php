<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model {
    // Wyłączamy obsługę kolumny updated_at, ponieważ logi mają tylko czas utworzenia
    const UPDATED_AT = null;

    protected $fillable = ['user_id', 'module', 'type', 'meta_data'];
}
