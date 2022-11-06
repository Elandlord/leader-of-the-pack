<section x-data="navigation()"
         @scroll.window="navigationSticky = (window.pageYOffset > 20) ? true : false"
         class="w-full z-10 transition"
         :class="{
            'bg-white block fixed top-0 border-b': navigationSticky,
            'absolute': !navigationSticky
         }"
    >
    <div class="grid grid-cols-3 py-4">
        <div class="flex justify-center">
            <a href="/">
                <img class="max-h-16 max-w-16" src="/assets/images/logo-pichi.png" />
            </a>
        </div>
        <nav class="flex items-center col-span-2">
            <ul class="flex gap-8 text-white" :class="{ 'text-black': navigationSticky }">
                <li>
                    <a href="/">
                        Home
                    </a>
                </li>
                <li>
                    <a href="/over-mij">
                        Over mij
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="absolute top-0 right-0 pr-20 pt-6 hidden lg:block">
        <button class="px-4 py-3 text-white hover:bg-lotp-blue-600 bg-lotp-blue-500 rounded-md font-bold transition">
            Klik voor een ontspannen wandeling voor uw hond
        </button>
    </div>
</section>

<script>
    /**
     * Alpine navigation object
     * @returns {Object}
    */
    function navigation() {
        return {
            navigationSticky: false
        }
    }
</script>
