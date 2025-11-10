<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndangeredAnimal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'map_id',
        'description',
        'image_path',
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}