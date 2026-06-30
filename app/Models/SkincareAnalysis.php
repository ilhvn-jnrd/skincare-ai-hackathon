<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkincareAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_names',
        'ai_response',
    ];
}