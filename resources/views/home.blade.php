<x-layout>
    <x-container>
        <h1>
            Welcome to the {{config('app.name')}} blog
        </h1>
        <h2>
            A complete guide to setting up a <span class="font-extrabold">CRUD application</span> using Laravel v10.
        </h2>
        <x-articles-grid :articles="$articles" />
    </x-container>
</x-layout>