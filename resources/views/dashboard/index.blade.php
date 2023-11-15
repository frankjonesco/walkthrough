<x-layout>
    <x-container>
        <h1>Dashboard</h1>
        <div class="btn-row">
            <a href="/articles/create" class="btn-success">
                Create a new article
            </a>
        </div>
        <div class="bg-gray-100 p-6 mt-10">
            <h2>Articles</h2>
            <div class="grid grid-cols-3 gap-6">
                @if(count($articles) > 0)
                    @foreach($articles as $article)
                        <div class="border bg-white p-4 flex flex-col gap-2">
                            <img src="{{$article->getImage('tn')}}">
                            <span class="font-bold text-xl">
                                {{$article->title}}
                            </span>
                            <span class="font-normal text-md">
                                {{$article->caption}}
                            </span>
                            <div class="flex gap-1">
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
                        </div>
                       
                    @endforeach
                @else
                    <x-alert class="alert-info" message="No articles to display." />
                @endif
            </div>
        </div>
    </x-container>    
</x-layout>