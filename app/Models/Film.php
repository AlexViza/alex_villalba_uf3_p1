<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'films';
    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
        ];

    public function actors()
    {
        return $this->belongsTo(Actor::class);
    }
}
