<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @hasSection('ogImage')
        @yield('ogImage')
    @else
        <meta property="og:image" content="{{ asset('img/snow-cessna.jpg') }}">
    @endif
    @hasSection('description')
        @yield('description')
    @else
        <meta name="description"
            content="{{ 'Europa bekijken vanuit de Cessna 172. Een blog over vliegen langs alle velden van Europa.' }}">
        <meta property="og:description"
            content="{{ 'Europa bekijken vanuit de Cessna 172. Een blog over vliegen langs alle velden van Europa.' }}">
    @endif
    @yield('keywords')
    <meta name="author" content="Bart Verhaegh">
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- whatsapp meta tags -->
    @hasSection('title')
        @yield('title')
    @else
        <title>{{ config('app.name') }}</title>
        <meta property="og:title" content="{{ 'Short Final' }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        pre {
            white-space: pre-wrap;
            /* Since CSS 2.1 */
            white-space: -moz-pre-wrap;
            /* Mozilla, since 1999 */
            white-space: -pre-wrap;
            /* Opera 4-6 */
            white-space: -o-pre-wrap;
            /* Opera 7 */
            word-wrap: break-word;
            /* Internet Explorer 5.5+ */
        }
    </style>
    <script type="text/javascript">
        (function(window, document, dataLayerName, id) {
            window[dataLayerName] = window[dataLayerName] || [], window[dataLayerName].push({
                start: (new Date).getTime(),
                event: "stg.start"
            });
            var scripts = document.getElementsByTagName('script')[0],
                tags = document.createElement('script');

            function stgCreateCookie(a, b, c) {
                var d = "";
                if (c) {
                    var e = new Date;
                    e.setTime(e.getTime() + 24 * c * 60 * 60 * 1e3), d = "; expires=" + e.toUTCString();
                    f = "; SameSite=Strict"
                }
                document.cookie = a + "=" + b + d + f + "; path=/"
            }
            var isStgDebug = (window.location.href.match("stg_debug") || document.cookie.match("stg_debug")) && !window
                .location.href.match("stg_disable_debug");
            stgCreateCookie("stg_debug", isStgDebug ? 1 : "", isStgDebug ? 14 : -1);
            var qP = [];
            dataLayerName !== "dataLayer" && qP.push("data_layer_name=" + dataLayerName), isStgDebug && qP.push(
                "stg_debug");
            var qPString = qP.length > 0 ? ("?" + qP.join("&")) : "";
            tags.async = !0, tags.src = "https://shortfinal.containers.piwik.pro/" + id + ".js" + qPString, scripts
                .parentNode.insertBefore(tags, scripts);
            ! function(a, n, i) {
                a[n] = a[n] || {};
                for (var c = 0; c < i.length; c++) ! function(i) {
                    a[n][i] = a[n][i] || {}, a[n][i].api = a[n][i].api || function() {
                        var a = [].slice.call(arguments, 0);
                        "string" == typeof a[0] && window[dataLayerName].push({
                            event: n + "." + i + ":" + a[0],
                            parameters: [].slice.call(arguments, 1)
                        })
                    }
                }(i[c])
            }(window, "ppms", ["tm", "cm"]);
        })(window, document, 'dataLayer', 'a2b45a88-cbf7-44fa-80bf-68e7bc17f95f');
    </script>
</head>

<body class="bg-gray-100 antialiased my-0 py-0 bg-cover bg-fixed relative"
    @if (isset($blog_article) && $blog_article->photo) style="background-image: url({{ Storage::url($blog_article->photo->path) }})" @endif>
    <div class="fixed w-full top-0 py-4 bg-white shadow z-50">
        <header>
            <div class="container mx-auto flex justify-between items-center ">
                <div style="width: 250px" class="pl-5 lg:pl-0">
                    <a href="{{ url('/') }}" class="text-2xl font-bold font-title">Short Final</a>
                </div>
                <nav>
                    <ul class="flex flex-row items-center space-x-10">
                        <li class="mx-2 hidden lg:inline-block">
                            <a href="/">Verslagen</a>
                        </li>
                        <li class="mx-2 pr-5 lg:pr-0">
                            <a href="https://www.flickr.com/photos/200008897@N03/albums">Foto's</a>
                        </li>
                        <li class="mx-2 hidden lg:inline-block">
                            <a href="https://instagram.com/irverhaegh">Instagram</a>
                        </li>
                        <li class="mx-2 hidden lg:inline-block">
                            <a href="https://www.eacm.nl" target="_blank">Eindhovense Aeroclub</a>
                        </li>
                    </ul>
                </nav>
                <div class="hidden lg:block" style="width: 250px">
                </div>
            </div>
        </header>
    </div>
    <div class="relative">

        <div class="backdrop-blur-lg z-10 h-full">

            @if (request()->routeIs('blog-article.index'))
                <div class="w-full"
                    style="background-image: url('{{ asset('img/snow-cessna.jpg') }}'); background-size: cover; height: 800px; background-position: center; z-index: 10">
                    <div class="mx-auto flex justify-center items-center h-full">
                        <div class="w-full mx-5 xl:mx-0 xl:w-1/2">
                        <div
                            class="mx-auto xl:mx-0 w-full max-w-md select-none text-dark shadow-lg p-5 bg-white border-gray-600 border-t-4"
                            >
                            <h1 class="text-4xl font-bold mb-2">Hi!</h1>
                            <p>Welkom op Short Final. <br/>
                                Hier vind je verslagen van vluchten die ik maak in de Cessna 172. Vanuit Eindhoven, door (hopelijk) steeds verder door Europa. Met het uiteindelijke doel zo veel mogelijk velden in Europa te bezoeken.
                                Dat doe ik niet alleen, maar met vrienden, mijn vader en mijn vriendin.<br/>
                                <br/>
                                Wil je ook een keer meevliegen? Laat het me weten!
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            @endif
            <main class="w-full container mx-auto z-50 pb-10 relative">
                <div class="mx-auto w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
