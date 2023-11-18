<x-layout>
    <x-container>
        <h1>{{$category->name}}</h1>
        <h2>{{$category->description}}</h2>
        <div class="articles-grid">
            @foreach ($category->articles as $article)
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
        </div>
    </x-container>
</x-layout>