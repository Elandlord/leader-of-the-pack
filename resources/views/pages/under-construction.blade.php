<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-no-repeat bg-center bg-cover"
      style="background-image: url('/assets/images/beetsterzwaag-bos.jpeg');">
<div class="my-32">
    <div class="container bg-slate-100 rounded-md mx-auto">
        <div class="flex justify-center py-4">
            <img src="/assets/images/logo-pichi.png"/>
        </div>
        <div class="text-center">
            <h1 class="pb-4 text-2xl font-bold">
                Hondenuitlaatservice in Beetsterzwaag
            </h1>
            <p class="pb-8">
                Onze website is in aanbouw, maar we zijn er klaar voor!
            </p>

            <div class="pb-4">
                <a class="bg-cyan-500 hover:bg-cyan-600 transition text-white rounded-md font-bold px-8 py-4" href="mailto:{{ config('mail.from.address') }}">
                    Neem contact op
                </a>
            </div>
        </div>
        <div class="py-8">
            <div class="flex flex-col sm:flex-row text-center sm:text-left justify-center">
                <a class="text-cyan-500" href="mailto:{{ config('mail.from.address') }}">
                    {{ config('mail.from.address') }}
                </a>
                <p class="px-4 hidden sm:block">|</p>
                <p>{{ config('app.phone_number') }}</p>
                <p class="px-4 hidden sm:block">|</p>
                <p>
                    {{ config('app.address') }}
                    {{ config('app.postcode') }},
                    {{ config('app.city') }}
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
