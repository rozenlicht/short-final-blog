<!DOCTYPE html>

<html>

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="mx-auto">
        <section class="splide" aria-labelledby="carousel-heading">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach ($slideshow->photos as $photo)
                        <li class="splide__slide mb-5">
                            <div class="rounded-lg overflow-hidden shadow-lg" style="height: 300px; width: 400px">
                                <img class="h-full w-full object-cover my-0" src="{{ Storage::url($photo->path) }}"
                                    alt="{{ $photo->description }}" />
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</body>

</html>
