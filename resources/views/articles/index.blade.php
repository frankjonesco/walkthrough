<x-layout>
    <x-container>
        <h1>News articles</h1>
        @auth
            <div class="btn-row">
                <a href="/articles/create" class="btn-green">
                    Create a new article
                </a>
            </div>
        @endauth
        @if(count($articles) > 0)
            {{-- List article results --}}
            <div class="w-1/3 mx-auto bg-gray-100 border border-gray-300 flex flex-col mb-20">
                
                @foreach ($articles as $i => $article)

                    <div class="article-card-sm @apply {{$loop->last ?: 'border-b pb-1'}}">
                        <div class="article-image"></div>
                        <span class="text-xl font-bold block">
                            {{$article->title}}
                        </span>

                        <span class="text-lg block">
                            {{$article->caption}}
                        </span>

                        <span class="text-lg block my-3">
                            <a href="/articles/{{$article->id}}" class="btn-blue-xs">
                                <i class="fa fa-arrow-right mr-1"></i>
                                View article
                            </a>
                        </span>
                    </div>
                                
                @endforeach
            </div>
        @else
            <x-alert class="alert-info" message="No articles to display." />
        @endif
    </x-container>
</x-layout>