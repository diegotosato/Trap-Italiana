<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Override;

class Artist extends Model
{
    protected $fillable = ['name', 'slug', 'spotify_id', 'image_url', 'description'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
