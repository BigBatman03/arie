<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SseitQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'subscale', 'is_reverse'];
}
