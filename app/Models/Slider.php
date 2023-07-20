<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'link'];

    protected function getImageAttribute()
    {
        return asset('storage/sliders/' . $this->attributes['image']);
    }
}
