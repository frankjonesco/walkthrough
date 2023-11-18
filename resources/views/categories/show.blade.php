<x-layout>
    <x-container>
        <h1>{{$category->name}}</h1>
        <h2>{{$category->description}}</h2>
        <x-articles-grid :articles="$articles" />
    </x-container>
</x-layout>