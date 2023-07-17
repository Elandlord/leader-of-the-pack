@extends('master')

@section('content')
    <section class="overflow-hidden">
        <div class="container mx-auto my-32 md:my-60">
            <div class="row animate__animated animate__fadeInLeft wow">
                <div class="text-center grid md:grid-cols-3 items-center justify-center">
                    <div class="md:col-span-2">
                        <h1 class="text-4xl mb-4 lg:text-5xl text-lotp-blue-500 font-ahsing tracking-widest">
                            {{ $page->sections->first()->flexible_title }}
                        </h1>

                        <p class="mt-4 text-xl font-medium">
                            {{ $page->sections->first()->flexible_text_block }}
                        </p>

                        <div class="flex flex-col lg:flex-row align-items-stretch justify-center w-full pt-8 shadow-lg ">
                            <div class="overflow-hidden bg-white rounded lg:max-w-xs w-full leading-normal">
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">E-mail</p>
                                    <a href="mailto:{{ config('mail.from.address') }}"
                                       class="text-lotp-blue-600 underline mb-2">{{ config('mail.from.address') }}</a>
                                </div>
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">Telefoon</p>
                                    <a class="text-lotp-blue-600 underline mb-2"
                                       href="tel:{{ config('app.phone_number') }}"
                                       class="text-grey-darker mb-2">{{ config('app.phone_number') }}</a>
                                </div>
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">WhatsApp</p>
                                    <a class="text-lotp-blue-600 underline mb-2"
                                       href="https://wa.me/{{ str_replace('-', '', Str::slug(config('app.phone_number'))) }}">
                                        {{ config('app.phone_number') }}
                                    </a>
                                </div>
                                <div class="block group p-4 border-b">
                                    <p class="font-bold text-lg mb-1 text-black">Adresgegevens</p>
                                    <p class="mb-2">
                                        {{ config('app.address') }}, {{ config('app.postcode') }} <br/>
                                        {{ config('app.city') }}
                                    </p>
                                </div>
                                <div class="block group p-4">
                                    <p class="font-bold text-lg mb-1 text-black">Bedrijfsgegevens</p>
                                    <p class="mb-2">
                                        KVK-nummer: {{ config('app.chamber_of_commerce') }} <br/>
                                        BTW-nummer: {{ config('app.vat_number') }}

                                    </p>
                                </div>
                            </div>
                            <div class="flex-1">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2397.3786245134515!2d6.076545875911648!3d53.06747149555402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c85008a4e9e6e5%3A0xeb6177cd5749cb0!2sUtgong%2037%2C%209244%20HE%20Beetsterzwaag!5e0!3m2!1snl!2snl!4v1689599060642!5m2!1snl!2snl"
                                    class="h-full w-full" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                        </div>
                    </div>

                    <div class="mt-8 md:mt-0">
                        <div class="flex justify-center">
                            <img src="/assets/images/logo-pichi.png" class="w-full md:w-3/5"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
