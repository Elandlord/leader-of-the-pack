<footer class="bg-slate-100">
    <div class="container mx-auto flex justify-around py-4 font-bold">
        <p class="font-medium underline">Tel: <a href="tel:">{{ config('app.phone_number') }}</p>
        <p class="text-lotp-blue-500">&copy; {{ Date('Y') }} {{ config('app.name') }}</p>
        <a class="font-medium underline" href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </div>
</footer>
