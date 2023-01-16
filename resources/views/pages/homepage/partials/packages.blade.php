<section class="container py-8 mx-auto">
    <div class="flex justify-center mt-12 mb-4">
        <h3 class="font-bold font-ahsing tracking-wider text-4xl">
            {{ $page->sections->get(2)->flexible_title }}
        </h3>
    </div>
    <div class="flex justify-center mb-12">
        <a class="text-center underline text-lotp-blue-500"
           target="_blank"
           href="/assets/files/uitlaattarieven-2022.pdf">Tarievenlijst download</a>
    </div>
    <div x-data="{ active: 0 }" class="grid gap-8 grid-cols-1 lg:grid-cols-2">
        @forelse ($prices as $price)
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
