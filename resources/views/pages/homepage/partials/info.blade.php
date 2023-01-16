<section class="container pt-8 mx-auto">
    <div class="flex justify-center">
        <div class="my-12 text-center">
            <h3 class="font-bold font-ahsing tracking-wider text-4xl">
                {{ $page->sections->get(1)->flexible_title }}
            </h3>
            <p class="py-8">
                {{ $page->sections->get(1)->flexible_text_block }}
            </p>
        </div>
    </div>
    <dl class="space-y-10 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 md:space-y-0">
        @forelse($reasons as $reason)
            <div @class([
                'relative animate__animated wow',
                'animate__fadeInLeft' => $loop->odd,
                'animate__fadeInRight' => $loop->even,
            ])>
                <dt>
                    <div class="absolute flex h-12 w-12 items-center justify-center align-center rounded-md bg-slate-700 text-white">
                        <span class="material-icons md-18">{{ $reason->icon }}</span>
                    </div>
                    <p class="ml-16 text-lg leading-6 text-lotp-blue-500">{{ $reason->why }}</p>
                </dt>
                @if(!empty($reason->solution))
                <dd class="mt-2 ml-16 text-base text-gray-500">
                    {{ $reason->solution }}
                </dd>
                @endif
            </div>
        @empty

        @endforelse
    </dl>
</section>
