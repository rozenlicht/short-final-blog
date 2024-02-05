<?php

namespace App\Models;

use App\Services\AirportService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogArticle extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'subtitle',
        'flight_date',
        'content',
        'slug',
        'photo_id',
        'flickr_url',
        'involved_icao',
    ];

    protected $dates = [
        'flight_date',
    ];

    protected $casts = [
        'involved_icao' => 'array'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }

    public function getIcaoAirportsAttribute()
    {
        return collect($this->involved_icao)->map(fn ($icao) => AirportService::getAirportByIcao($icao));
    }

    public function render()
    {
        $content = $this->content;
        // find tags like [[slideshow:1]] and replace them with the actual slideshow
        preg_match_all('/\[\[slideshow:(\d+)\]\]/', $content, $matches);
        foreach ($matches[1] as $match) {
            $slideshow = Slideshow::findOrFail($match);
            $content = str_replace("[[slideshow:$match]]", view('slideshow.embed', compact('slideshow'))->render(), $content);
        }
        // find tags like [[photo:1]] and replace them with the actual photo
        preg_match_all('/\[\[photo:(\d+)\]\]/', $content, $matches);
        foreach ($matches[1] as $match) {
            $photo = Photo::findOrFail($match);
            $content = str_replace("[[photo:$match]]", view('slideshow.photo-embed', compact('photo'))->render(), $content);
        }
        // find tags like [[audio:1]] and replace them with the actual audio fragment
        preg_match_all('/\[\[audio:(\d+)\]\]/', $content, $matches);
        foreach ($matches[1] as $match) {
            $audioFragment = AudioFragment::findOrFail($match);
            $content = str_replace("[[audio:$match]]", view('slideshow.audio-embed', compact('audioFragment'))->render(), $content);
        }
        return $content;
    }
}
