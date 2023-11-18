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
            @if(count($article->splitTags()) > 1)
                <span class="font-light text-xs mt-2">
                    @foreach ($article->splitTags() as $tag)
                        <a href="/tags/{{trim($tag)}}" class="px-2.5 py-1 bg-yellow-200 rounded-lg mr-0.5 text-gray-900 transition-all duration-150 ease-in-out hover:-translate-y-0.5 hover:bg-amber-200 inline-block">{{trim($tag)}}</a>
                    @endforeach
                </span>
            @endif
        </div>
    @endforeach
</div>