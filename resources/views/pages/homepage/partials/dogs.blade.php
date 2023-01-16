<section class="container py-8 mx-auto">
    <div class="flex justify-center my-12">
        <h3 class="font-bold font-ahsing tracking-wider text-4xl">
            {{ $page->sections->get(3)->flexible_title }}
        </h3>
    </div>

    <div class="mt-6 grid gap-8 grid-cols-1 md:grid-cols-2">
        @forelse($dogs as $dog)
            <figure
                @class([
                    'bg-slate-100 rounded-xl p-8 animate__animated wow',
                    'animate__fadeInLeft' => $loop->odd,
                    'animate__fadeInRight' => $loop->even,
                ])
            >
                @if ($dog->photo !== null)
                    <img class="w-60 h-60 object-cover object-center rounded-full mx-auto" src="{{ $dog->photo }}" alt="" width="384" height="512">
                @endif
                <div class="pt-6 text-center space-y-4">
                    <blockquote>
                        <p class="text-lg font-medium">
                            {{ $dog->description }}
                        </p>
                    </blockquote>
                    <figcaption>
                        <div class="text-lotp-blue-500 font-bold">
                            {{ $dog->name }}
                            @if ($dog->breed !== null)
                                <span class="font-medium">({{ $dog->breed }})</span>
                            @endif
                        </div>
                        @if ($dog->birthyear > 0)
                            <div class="text-slate-500">
                                Geboren in {{ $dog->birthyear }}
                            </div>
                        @endif
                    </figcaption>
                </div>
            </figure>
        @empty

        @endforelse
    </div>

</section>
