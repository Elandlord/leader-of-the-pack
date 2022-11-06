<section class="container pt-8 mx-auto">
    <div class="flex justify-center">
        <div class="my-12 text-center">
            <h3 class="font-bold font-ahsing tracking-wider text-4xl">Reviews</h3>
            <span class="text-lotp-blue-500">Beoordeeld met een gemiddelde van {{ rand(8,9) }}.{{ rand(0, 9) }}</span>
        </div>
    </div>
</section>

@php
    $reviews = [
        (object) [
            'author' => 'Eric Landheer',
            'dog' => 'Kiara',
            'type' => 'Wandeling',
            'location' => 'Beetsterzwaag',
            'image_url' => '/assets/images/kiara.png',
            'description' => 'Top service! Mijn hond en ik zijn tevreden! Zo hond, zo baas.',
            'stars' => 5
        ],
        (object) [
            'author' => 'Jelle Hoekstra',
            'dog' => 'Vegas',
            'type' => 'Oppas',
            'location' => 'Beetsterzwaag',
            'image_url' => '/assets/images/vegas-thuis.png',
            'description' => 'Ik heb een energieke hond die veel uit moet. Jelle biedt de uitkomst. Hij is kalm en erg begaan met honden. Wanneer mijn hond thuiskomt van de wandeling is hij altijd blij en lekker uitgeteld!',
            'stars' => 5
        ],
        (object) [
            'author' => 'Eric Landheer',
            'dog' => 'Kiara',
            'type' => 'Wandeling',
            'location' => 'Beetsterzwaag',
            'image_url' => '/assets/images/kiara.png',
            'description' => 'Door mijn onregelmatige diensten kan ik onze Fardau niet altijd uitlaten. Gelukkig kan ze altijd met Jelle en de roedel mee. Elke keer leeft ze helemaal op na een wandeling. Wij zijn erg blij met Jelle. Hij is zo lief voor onze Fardau!',
            'stars' => 5
        ],
        (object) [
            'author' => 'Jelle Hoekstra',
            'dog' => 'Vegas',
            'type' => 'Oppas',
            'location' => 'Beetsterzwaag',
            'image_url' => '/assets/images/vegas-thuis.png',
            'description' => 'Positief, snel en makkelijk contact. Jelle is rustig, straalt liefde voor dieren uit, is betrouwbaar en prettig in de omgang.',
            'stars' => 5
        ],
    ];
@endphp

<div class="container pb-8 mx-auto" x-data="{
        init() {
            new Splide(this.$refs.splide, {
                perPage: 2,
                gap: '2rem',
                breakpoints: {
                    640: {
                        perPage: 1,
                    },
                },
            }).mount()
        },
    }">
    <section x-ref="splide" class="splide px-8 md:px-16 py-8  animate__animated wow animate__fadeIn">
        <div class="splide__track">
            <ul class="splide__list">
                @forelse(array_merge($reviews, $reviews) as $review)
                    <li class="splide__slide bg-slate-100 rounded-xl p-8">
                        <div class="flex items-center mb-4 space-x-4">
                            <img class="w-10 h-10 rounded-full" src="{{ $review->image_url }}" alt="">
                            <div class="space-y-1 font-medium">
                                <p>{{ $review->author }}<span class="block text-sm text-lotp-blue-500">Beoordeeld voor: {{ $review->type }}</span></p>
                            </div>
                        </div>
                        <div class="flex items-center mb-1">
                            @foreach(range(1, $review->stars) as $star)
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endforeach
                        </div>
                        <footer class="mb-5 text-slate-500"><p>{{ $review->location }}, <span>{{ now()->format('Y-m-d') }}</span></p></footer>
                        <p class="mb-2">{{ $review->description }}</p>
                    </li>
                @empty

                @endforelse
            </ul>
        </div>
    </section>

</div>
