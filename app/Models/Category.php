<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image'];

    protected function getImageAttribute()
    {
        return asset('/storage/categories/'. $this->attributes['image']);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
