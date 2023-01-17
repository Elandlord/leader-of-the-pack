<section class="container py-8 mx-auto">
    <div class="flex justify-center my-12">
        <h3 class="font-bold font-ahsing tracking-wider text-4xl">
            {{ $page->sections->get(3)->flexible_title }}
        </h3>
    </div>

    <div x-data="{
            dogs: {{ $dogs }},
            maxItems: 4,

            get paginatedDogs() {
                return this.dogs.filter((dog, index) => index < this.maxItems);
            }
        }">
        <div class="mt-6 grid gap-8 grid-cols-1 md:grid-cols-2">
            <template x-for="(dog, index) in paginatedDogs">
                <figure
                    class="bg-slate-100 rounded-xl p-8 animate__animated wow"
                        :class="{
                            'animate__fadeInLeft': index % 2 === 0,
                            'animate__fadeInRight': index % 2 === 1,
                        }"
                >
                    <template x-if="dog.photo !== null">
                        <img class="w-60 h-60 object-cover object-center rounded-full mx-auto shadow-md border-8 border-white"
                             :src="dog.photo" width="384" height="512">
                    </template>
                    <div class="pt-6 text-center space-y-4">
                        <blockquote>
                            <p class="text-lg font-medium" x-text="dog.description"></p>
                        </blockquote>
                        <figcaption>
                            <div class="text-lotp-blue-500 font-bold">
                                <span x-text="dog.name"></span>
                                <template x-if="dog.breed !== null">
                                    <span class="font-medium" x-text="'(' + dog.breed + ')'"></span>
                                </template>
                            </div>
                            <template x-if="dog.birthyear > 0">
                                <div class="text-slate-500">
                                    Geboren in <span x-text="dog.birthyear"></span>
                                </div>
                            </template>
                        </figcaption>
                    </div>
                </figure>
            </template>
        </div>
        <template x-if="dogs.length > maxItems">
            <div class="flex justify-center mt-8">
                <button class="px-4 py-3 text-lotp-blue-500 hover:text-lotp-blue-600
                               border-2 hover:border-lotp-blue-600 border-lotp-blue-500
                               rounded-md font-bold transition"
                        @click="maxItems += 4">Laad meer honden</button>
            </div>
        </template>
    </div>
</section>
