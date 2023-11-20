<x-layout :meta="$meta">
    <x-container>
        <div class="breadcrums mx-auto w-fit text-sm">
            <span>
                <a href="/articles" class="text-gray-900">
                    News
                </a>
            </span>
            <span>></span>
            <span>
                <a href="/categories" class="font-bold no-underline underline-offset-2">
                    Categories
                </a>
            </span>
        </div>
        <h1>{{$category->name}}</h1>
        <h2>{{$category->description}}</h2>
        <x-articles-grid :articles="$articles" />
    </x-container>
</x-layout>