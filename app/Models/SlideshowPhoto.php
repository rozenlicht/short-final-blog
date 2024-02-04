<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SlideshowPhoto extends Pivot
{
    protected $table = 'slideshow_photo';

    public function slideshow()
    {
        return $this->belongsTo(Slideshow::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}
