@extends('layouts.app')

@section('content')
    <div class="mb-5 -mt-16 mx-auto container max-w-3xl bg-white rounded-lg p-10 shadow" style="z-index: 50">
        <h1 class="text-3xl font-bold mb-10">Vluchtverslagen</h1>
        @foreach ($blog_articles as $article)
            <article class=" mx-auto @if (!$loop->last) border-b @endif">
                <div class="flex flex-row justify-between items-center py-3">
                    <div class="flex flex-col">
                        <h2 class="py-0 my-0 text-2xl font-bold">{{ $article->title }}</h2>
                        <span class="text-base font-bold mb-2">{{ $article->subtitle }}</span>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('blog-article.show', $article->slug) }}" class="underline">Lezen ></a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endsection
