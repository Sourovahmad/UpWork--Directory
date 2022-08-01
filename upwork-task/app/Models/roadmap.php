<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roadmap extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image',
    ];

    public function items()
    {
        return $this->hasMany(phaseItem::class, 'roadmap_id','id');
    }
}
