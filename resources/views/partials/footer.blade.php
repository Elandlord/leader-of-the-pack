<footer class="bg-gray-200">
    <div class="container mx-auto flex justify-around py-4 font-bold">
        <p>Tel: <a href="tel:"{{ config('app.phone_number') }}</p>
        <p>&copy; {{ Date('Y') }} {{ config('app.name') }}</p>
        <a href="mailto:{{ config('mail.from.address') }}">{{ config('mail.from.address') }}</a>
    </div>
</footer>
