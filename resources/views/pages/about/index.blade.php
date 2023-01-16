@extends('master')

@section('content')
    <section class="overflow-hidden">
        <div class="container mx-auto my-32 md:my-60">
            <div class="row animate__animated animate__fadeInLeft wow">
                <div class="text-center">
                    <h1 class="text-4xl mb-4 lg:text-5xl text-lotp-blue-500 font-ahsing tracking-widest">
                        {{ $page->sections()->first()->flexible_title }}
                    </h1>
                    <p class="mt-4 text-xl font-medium">
                        {{ $page->sections()->first()->flexible_text_block }}
                    </p>

                    <p class="mt-4 text-xl font-medium">
                        {{ $page->sections()->first()->flexible_content['text_block'][1] }}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
