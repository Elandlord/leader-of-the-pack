<section class="container pt-8 mx-auto">
    <div class="flex justify-center">
        <div class="my-12 text-center">
            <h3 class="font-bold font-ahsing tracking-wider text-4xl">Leader of the Pack</h3>
            <p class="py-8">
                Ik neem je hond mee in roedelverband naar de bossen, waar ze heerlijk kunnen rennen en spelen. Rust in huis. En bovenal: een opgeluchte en een blije hond! Een blije hond is een blij thuis!
            </p>
        </div>
    </div>

    @php
        $reasons = [
            (object) [
                'why' => 'Tijd tekort?',
                'solution' => 'Kom je structureel tijd te kort om je trouwe viervoeter uit te laten? ',
                'icon' => 'schedule',
            ],
            (object) [
                'why' => 'Gun je hem/haar het allerbeste?',
                'solution' => 'Ik bied aan om je trouwe viervoeter met alle liefde, zorg en plezier uit te laten of te verzorgen.',
                'icon' => 'favorite',
            ],
            (object) [
                'why' => 'Vertrouw je je hond niet zomaar aan iedereen toe?',
                'solution' => "Dat is begrijpelijk. Naast dat ik een groot hart voor honden heb, ben ik een gecertificeerde hondenuitlaatservice. Zo heb ik mijn diploma's behaald aan de Martin Gaus Academie.",
                'icon' => 'psychology_alt',
            ],
            (object) [
                'why' => 'Is je hond liever alleen?',
                'solution' => 'Heb je liever dat je hond alleen uitgelaten wordt, omdat je hond bijvoorbeeld niet goed met andere honden kan? Individueel uitlaten behoort ook tot de mogelijkheden.',
                'icon' => 'pets',
            ],
        ];
    @endphp

    <dl class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0">
        @forelse($reasons as $reason)
        <div @class([
            'relative animate__animated wow',
            'animate__fadeInLeft' => $loop->odd,
            'animate__fadeInRight' => $loop->even,
        ])>
            <dt>
                <div class="absolute flex h-12 w-12 items-center justify-center rounded-md bg-slate-700 text-white">
                    <span class="material-icons md-18">{{ $reason->icon }}</span>
                </div>
                <p class="ml-16 text-lg leading-6 text-lotp-blue-500">{{ $reason->why }}</p>
            </dt>
            <dd class="mt-2 ml-16 text-base text-gray-500">
                {{ $reason->solution }}
            </dd>
        </div>
        @empty

        @endforelse
    </dl>
</section>
