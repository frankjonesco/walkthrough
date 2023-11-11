<x-layout>
    <x-container class="!w-1/2">
        <div class="article-card">
            <h1>{{$article->title}}</h1>
            <h2>{{$article->caption}}</h2>
            <div class="article-image"></div>
            <span>{{$article->body}}</span>
        </div>
    </x-container>
</x-layout>