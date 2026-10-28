@php
    $types = ['Local Walks'];
@endphp

@forelse(range(0, count($types) - 1) as $index)
    <section class="container mx-auto my-32 md:my-60">
        <div class="flex justify-center mb-4">
            <div class="text-center">
                <h1 class="text-4xl mb-4 lg:text-5xl text-lotp-blue-500 font-ahsing tracking-widest">
                    {{ $page->sections->get($index)->flexible_title }}
                </h1>
                <p class="mt-2 text-sm text-slate-600">
                    Alle tarieven zijn voor wandelingen in Beetsterzwaag.
                </p>
            </div>
        </div>
        <div x-data="{ active: 0 }" class="grid gap-8 grid-cols-1 lg:grid-cols-2">
            @forelse ($prices->where('type', $types[$index]) as $price)
                <div x-data="{
                id: {{ $loop->iteration }},
                get expanded() {
                    return this.active === this.id
                },
                set expanded(value) {
                    this.active = value ? this.id : null
                },
            }" role="region"@class([
                    'rounded-lg bg-slate-100 shadow animate__animated wow',
                    'animate__fadeInLeft' => $loop->odd,
                    'animate__fadeInRight' => $loop->even,
                ])
                >
                    <button
                        x-on:click="expanded = !expanded"
                        :aria-expanded="expanded"
                        class="flex w-full items-center justify-between px-6 py-4 text-xl font-bold"
                    >
                        <div class="flex gap-x-4 items-center justify-center">
                            <img src="/assets/icons/{{ $price->icon }}.png"
                                 class="object-cover"
                                 style="height: 75px; width: 100px;"
                                 alt="Man met hond" />
                            <h2 class="font-normal">{{ $price->name }} </h2>
                            <span class="font-bold">(&euro;{{ $price->costs }})</span>
                        </div>
                        <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                        <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                    </button>

                    <div x-show="expanded" x-collapse>
                        <div class="px-6 pb-4">{{ $price->description }}</div>
                    </div>
                </div>
            @empty
                Geen prijzen gevonden.
            @endforelse
        </div>
    </section>
@empty

@endforelse
