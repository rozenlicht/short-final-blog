<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'caption'
    ];

    public function slideshowPhotos()
    {
        // n:m via SlideshowPhoto pivot
        return $this->hasMany(SlideshowPhoto::class);
    }

    public function slideshows()
    {
        // n:m via SlideshowPhoto pivot
        return $this->belongsToMany(Slideshow::class, 'slideshow_photo');
    }
}
