<section class="container pt-8 mx-auto">
    <div class="flex justify-center">
        <div class="my-12 text-center">
            <h3 class="font-bold font-ahsing tracking-wider text-4xl">
                {{ $page->sections->get(3)->flexible_title }}
            </h3>

            @if ($reviews->count() > 0)
                <span class="text-lotp-blue-500">Beoordeeld met een {{ round($reviews->avg('rating'), 1) * 2 }} ({{ $reviews->count() }} reviews)</span>
            @endif
        </div>
    </div>
</section>

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
                @forelse($reviews as $review)
                    <li class="splide__slide bg-slate-100 rounded-xl p-8">
                        <div class="flex items-center mb-4 space-x-4">
                            @if ($review->dog()->exists() && $review->dog->photo !== null)
                                <img class="w-10 h-10 rounded-full" src="{{ $review->dog->photo }}" alt="">
                            @endif
                            @if ($review->type)
                                <div class="space-y-1 font-medium">
                                    <p>{{ $review->author }}<span class="block text-sm text-lotp-blue-500">Beoordeeld voor: {{ $review->type }}</span></p>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center mb-1">
                            @foreach(range(1, $review->rating) as $rating)
                                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Star {{ $rating }}</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            @endforeach
                        </div>
                        <footer class="mb-5 text-slate-500"><p>{{ $review->location }}, <span>{{ $review->created_at->format('Y-m-d') }}</span></p></footer>
                        <p class="mb-2">{{ $review->text }}</p>
                    </li>
                @empty

                @endforelse
            </ul>
        </div>
    </section>

</div>
