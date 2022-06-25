@php
    $packages = [
        (object) [
            'title' => '1 HOND LOSSE WANDELING',
            'description' => 'In overleg privé of groepswandeling mogelijk.',
            'price' => '€12,50'
        ],
        (object) [
            'title' => '1 HOND STRIPPENKAART',
            'description' => '10 uren naar wens te besteden. De strippenkaart is 4 maanden geldig.',
            'price' => '€105'
        ],
        (object) [
            'title' => '2 HONDEN LOSSE WANDELING',
            'description' => 'Geldig wanneer twee honden opgehaald worden van één adres.',
            'price' => '€21'
        ],
        (object) [
            'title' => '2 HONDEN STRIPPENKAART',
            'description' => '10 uren naar wens te besteden. 2 honden van hetzelfde adres. 4 maanden geldig.',
            'price' => '€185'
        ],
    ];
@endphp

<section class="container py-8 mx-auto">
    <div class="flex justify-center my-12">
        <h3 class="font-bold text-3xl">Tarieven</h3>
    </div>
    <div class="grid gap-x-8 grid-cols-1 lg:grid-cols-4">
        @forelse ($packages as $package)
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <div class="flex justify-center my-4">
                        <img src="/assets/icons/man-with-dog.png" alt="Man met hond" />
                    </div>
                    <h3 class="text-lg font-medium leading-6 text-center text-gray-900">
                        {{ $package->title }}
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-center text-gray-500">
                        {{ $package->description }}
                    </p>
                    <h3 class="pt-4 text-3xl font-bold text-center">
                        {{    $package->price }}
                    </h3>
                </div>
            </div>
        @empty
            Geen pakketten gevonden.
        @endforelse
    </div>
</section>
