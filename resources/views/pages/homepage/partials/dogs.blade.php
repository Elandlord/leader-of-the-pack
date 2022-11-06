<section class="container py-8 mx-auto">
    <div class="flex justify-center my-12">
        <h3 class="font-bold font-ahsing tracking-wider text-4xl">Wandelhonden</h3>
    </div>

    <?php
        $dogs = [
            (object) [
                'name' => 'Vegas',
                'description' => 'Vegas is een onwijs lieve hond met een behoefte aan duidelijkheid. Vegas is intelligent, maar soms was onafhankelijk en koppig. Siberische Husky\'s zijn dol op het gezelschap van mensen.',
                'breed' => 'Husky',
                'birthyear' => 2019,
                'image_url' => '/assets/images/vegas-thuis.png',
            ],
            (object) [
                'name' => 'Kiara',
                'description' => 'Een echte dame met koppige trekjes. Zo laat ze duidelijk merken als ze genoeg heeft gehad van een wandeling. In tegenstelling tot andere honden, houdt ze niet erg van regen.',
                'breed' => 'Schotse Collie',
                'birthyear' => 2008,
                'image_url' => '/assets/images/kiara.png',
            ],
            (object) [
                'name' => 'Vegas',
                'description' => 'Vegas is een onwijs lieve hond met een behoefte aan duidelijkheid. Vegas is intelligent, maar soms was onafhankelijk en koppig. Siberische Husky\'s zijn dol op het gezelschap van mensen.',
                'breed' => 'Husky',
                'birthyear' => 2019,
                'image_url' => '/assets/images/vegas-thuis.png',
            ],
            (object) [
                'name' => 'Kiara',
                'description' => 'Een echte dame met koppige trekjes. Zo laat ze duidelijk merken als ze genoeg heeft gehad van een wandeling. In tegenstelling tot andere honden, houdt ze niet erg van regen.',
                'breed' => 'Schotse Collie',
                'birthyear' => 2008,
                'image_url' => '/assets/images/kiara.png',
            ],
        ];
    ?>

    <div class="mt-6 grid gap-8 grid-cols-1 md:grid-cols-2">
        @forelse($dogs as $dog)
            <figure
                @class([
                    'bg-slate-100 rounded-xl p-8 animate__animated wow',
                    'animate__fadeInLeft' => $loop->odd,
                    'animate__fadeInRight' => $loop->even,
                ])
            >
                <img class="w-60 h-60 object-cover object-center rounded-full mx-auto" src="{{ $dog->image_url }}" alt="" width="384" height="512">
                <div class="pt-6 text-center space-y-4">
                    <blockquote>
                        <p class="text-lg font-medium">
                            {{ $dog->description }}
                        </p>
                    </blockquote>
                    <figcaption>
                        <div class="text-lotp-blue-500 font-bold">
                            {{ $dog->name }} <span class="font-medium">({{ $dog->breed }})</span>
                        </div>
                        <div class="text-slate-500">
                            Geboren in {{ $dog->birthyear }}
                        </div>
                    </figcaption>
                </div>
            </figure>
        @empty

        @endforelse
    </div>

</section>
