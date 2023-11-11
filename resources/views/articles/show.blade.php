<x-layout>
    <x-container class="!w-1/2">
        <div class="article-card">
            <h1>{{$article->title}}</h1>
            <h2>{{$article->caption}}</h2>
            <div class="publish-info">
                <span>
                    Author: {{$article->user->fullName()}}
                </span>
                <span>Published: {{showDateTime($article->created_at)}}</span>
            </div>
            <div class="article-image">
                <img src="{{$article->getImage()}}">
            </div>
            <span>{!!nl2p($article->body)!!}</span>
        </div>
    </x-container>
</x-layout>