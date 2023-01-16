<footer class="bg-slate-100">
    <div class="container mx-auto block md:flex text-center md:text-left justify-around py-4 font-bold">
        <p class="font-medium underline py-1 md:py-0">Tel: <a href="tel:">{{ config('app.phone_number') }}</p>
        <p class="text-lotp-blue-500 py-1 md:py-0">&copy; {{ Date('Y') }} {{ config('app.name') }}</p>
        <a class="font-medium underline py-1 md:py-0" href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </div>
</footer>
