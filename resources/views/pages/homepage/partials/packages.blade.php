@php
    $packages = [
        (object) [
            'title' => '1 hond, losse wandeling',
            'description' => 'In overleg privé of groepswandeling mogelijk.',
            'price' => '€12,50'
        ],
        (object) [
            'title' => '1 hond, strippenkaart',
            'description' => '10 uren naar wens te besteden. De strippenkaart is 4 maanden geldig.',
            'price' => '€105'
        ],
        (object) [
            'title' => '2 honden, losse wandeling',
            'description' => 'Geldig wanneer twee honden opgehaald worden van één adres.',
            'price' => '€21'
        ],
        (object) [
            'title' => '2 honden, strippenkaart',
            'description' => '10 uren naar wens te besteden. 2 honden van hetzelfde adres. 4 maanden geldig.',
            'price' => '€185'
        ],
    ];
@endphp

<section class="container py-8 mx-auto">
    <div class="flex justify-center my-12">
        <h3 class="font-bold font-ahsing tracking-wider text-4xl">Tarieven</h3>
    </div>
    <div x-data="{ active: 0 }" class="grid gap-8 grid-cols-1 lg:grid-cols-2">
        @forelse ($packages as $package)
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
                        <img src="/assets/icons/man-with-dog.png" alt="Man met hond" />
                        <h2 class="font-normal">{{ $package->title }} </h2>
                        <span class="font-bold">({{ $package->price }})</span>
                    </div>
                    <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                    <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                </button>

                <div x-show="expanded" x-collapse>
                    <div class="px-6 pb-4">{{ $package->description }}</div>
                </div>
            </div>
        @empty
            Geen pakketten gevonden.
        @endforelse
    </div>
</section>
