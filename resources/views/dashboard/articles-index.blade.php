<x-layout>
    <x-container>
        <h1>Manage news articles</h1>
        <h2>Manage the news articles for the site.</h2>
        <div class="btn-row">
            <a href="/articles/create" class="btn-success">
                Create a new article
            </a>
        </div>
        <div class="articles-grid mt-10">
            @if(count($articles) > 0)
                @foreach($articles as $article)
                    <div class="article-card-sm">
                        <div>
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
                        @if(verifyPermissions($article))
                            <div class="flex gap-1 pt-6">
                                <a href="/articles/{{$article->hex}}/edit" class="btn-success-xs">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                <a href="/articles/{{$article->hex}}/image" class="btn-info-xs">
                                    <i class="fa fa-image"></i>
                                    Change image
                                </a>
                                <a href="/articles/{{$article->hex}}/confirm-delete" class="btn-danger-xs">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <x-alert class="alert-info" message="No articles to display." />
            @endif
        </div>

        {{$articles->links()}}
    </x-container>
</x-layout>