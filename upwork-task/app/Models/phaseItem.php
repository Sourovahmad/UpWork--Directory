<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phaseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'roadmap_id', 'item',
    ];
}
