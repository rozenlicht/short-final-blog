<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function slideshowPhotos()
    {
        // n:m via SlideshowPhoto pivot
        return $this->hasMany(SlideshowPhoto::class);
    }

    public function photos()
    {
        // n:m via SlideshowPhoto pivot
        return $this->belongsToMany(Photo::class, 'slideshow_photo');
    }

    public function getEmbedCodeAttribute(): string
    {
        return route('slideshow.embed', $this->id);
    }
}
