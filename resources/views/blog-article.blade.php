@extends('layouts.app')

@section('description')
    <meta name="description" content="{{ $blog_article->subtitle }}">
@endsection

@section('keywords')
    <meta name="keywords"
        content="{{ $blog_article->title }}, {{ $blog_article->icao_airports->implode('name', ', ') }}, Cessna 172, EACm, Eindhoven vliegen, vliegen">
@endsection

@section('content')
    <div class="prose w-full mx-auto shadow-lg rounded-xl mb-12 bg-white mt-10 overflow-hidden">
        @if ($blog_article->photo)
            <div
                style="width: 100%; height: 300px; background-image: url('{{ Storage::url($blog_article->photo->path) }}'); background-size: cover; background-position: center;">
            </div>
        @endif
        <div class="p-10 w-full">
            <h1 class="text-3xl font-bold mb-2">{{ $blog_article->title }}</h1>
            <span class="text-lg font-bold block">{{ $blog_article->subtitle }}</span>
            @if ($blog_article->flight_date)
                <span class="font-bold block">Een vlucht op
                    {{ \Carbon\Carbon::parse($blog_article->flight_date)->translatedFormat('d F Y') }}
                </span>
            @endif
            @if ($blog_article->flickr_url)
                <a href="{{ $blog_article->flickr_url }}" target="_blank" class="underline text-xs">Bekijk alle foto's op
                    Flickr</a>
            @endif
            <div class="my-5 break-words [&>pre]:text-xs [&>pre]:bg-gray-100 [&>pre>strong>em]:break-words">

                {!! $blog_article->render() !!}
                <div class="text-gray-500">
                    <hr class="my-5" />
                    <h5 class="text-sm font-bold text-gray-500">Betrokken vliegvelden:</h5>
                    <ul class="list-disc list-inside my-0 text-gray-500">
                        @foreach ($blog_article->icao_airports as $airport)
                            <li class="text-xs">{{ $airport['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
