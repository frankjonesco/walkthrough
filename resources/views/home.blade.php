<x-layout>
    <x-container>
        <h1>Welcome to the {{config('app.name')}} blog</h1>
        <h2>A complete guide to setting up a <span class="font-extrabold">CRUD application</span> using Laravel v10</h2>
        <div class="articles-grid">
            @foreach ($articles as $article)
                <div class="article-card-sm">
                    <a href="/articles/{{$article->hex}}">
                        <img src="{{$article->getImage('tn')}}">
                    </a>
                    <a href="/articles/{{$article->hex}}">
                        <span class="title">
                            {{$article->title}}
                        </span>
                    </a>
                    <span class="date">{{showDateTime($article->created_at)}}</span>
                </div>
            @endforeach
    </x-container>
</x-layout>