<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<main class="grid place-items-center min-h-[100vh]">
    <header class="flex flex-col justify-center items-center">
        <x-application-logo class="w-[75vw] md:w-[50vw] lg:w-[30vw]"/>
        <p class="text-xl font-medium tracking-wider">Solusi Pomodoro Berbasis AI</p>
        <a class="mt-8" href="{{ route('register') }}">
            <x-primary-button class="py-4 px-6">Get Started</x-primary-button>
        </a>
    </header>
    <section class="mx-auto max-w-5xl grid place-items-center gap-8">
        <h2 class="text-2xl font-semibold tracking-wider">Fitur-fitur</h2>
        <div class="flex flex-wrap justify-center gap-8">
            <div class="p-8 max-w-md border rounded-lg transition duration-300 hover:shadow-lg hover:scale-[0.995]">
                <h3 class="font-medium text-lg">Habit Monitoring</h3>
                <p class="text-justify">Amati kebiasaan belajar Anda.</p>
            </div>
            <div class="p-8 max-w-md border rounded-lg transition duration-300 hover:shadow-lg hover:scale-[0.995]">
                <h3 class="font-medium text-lg">Roadmap Planner</h3>
                <p class="text-justify">Alokasikan waktu belajar Anda agar lebih efisien dan efektif.</p>
            </div>
            <div class="p-8 max-w-md border rounded-lg transition duration-300 hover:shadow-lg hover:scale-[0.995]">
                <h3 class="font-medium text-lg">Roadmap Maker</h3>
                <p class="text-justify">Generate Roadmap dengan dukungan teknologi Artificial Intelligence sebagai
                    pedoman belajar Anda.</p>
            </div>
        </div>
    </section>
    <footer class="text-center mt-8">
        <span>Made with ❤️ by <a class="text-purple-800 underline" href="https://aydinpramasta.me" target="_blank">Aydin Pramasta</a></span>
    </footer>
</main>
</body>
</html>
