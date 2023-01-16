@extends('master')

@section('content')
    <section class="overflow-hidden">
        <div class="container mx-auto my-32 md:my-60">
            <div class="row animate__animated animate__fadeInLeft wow">
                <div class="text-center grid md:grid-cols-2 items-center justify-center">
                    <div class="order-last md:order-first mt-8 md:mt-0">
                        <div class="flex justify-center">
                            <img src="/assets/images/logo-pichi.png" class="w-full md:w-3/5" />
                        </div>
                    </div>

                    <div class="order-first md:order-last">
                        <h1 class="text-4xl mb-4 lg:text-5xl text-lotp-blue-500 font-ahsing tracking-widest">
                            {{ $page->sections->first()->flexible_title }}
                        </h1>

                        <p class="mt-4 text-xl font-medium">
                            {{ $page->sections->first()->flexible_text_block }}
                        </p>

                        <div class="flex items-center justify-center w-full pt-8">
                            <div class="overflow-hidden bg-white rounded max-w-xs w-full shadow-lg leading-normal">
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">E-mail</p>
                                    <a href="mailto:{{ config('mail.from.address') }}"
                                       class="text-lotp-blue-600 underline mb-2">{{ config('mail.from.address') }}</a>
                                </div>
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">Telefonisch</p>
                                    <a class="text-lotp-blue-600 underline mb-2" href="tel:{{ config('app.phone_number') }}"
                                        class="text-grey-darker mb-2">{{ config('app.phone_number') }}</a>
                                </div>
                                <div class="block group p-4">
                                    <p class="font-bold text-lg mb-1 text-black">WhatsApp</p>
                                    <a  class="text-lotp-blue-600 underline mb-2"
                                        href="https://wa.me/{{ str_replace('-', '', Str::slug(config('app.phone_number'))) }}">
                                        {{ config('app.phone_number') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
