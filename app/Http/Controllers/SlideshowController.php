<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    public function embed($id)
    {
        $slideshow = Slideshow::findOrFail($id);
        return view('slideshow.embed', compact('slideshow'));
    }

    public function photoEmbed($id)
    {
        $photo = Photo::findOrFail($id);
        return view('slideshow.photo-embed', compact('photo'));
    }
}
