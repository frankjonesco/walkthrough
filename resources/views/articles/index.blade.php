<x-layout>
    <x-container>
        <h1>News articles</h1>
        <div class="bg-gray-100 p-6">
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
                            <span class="font-normal text-xs text-slate-500">
                                {{showDateTime($article->created_at)}}
                            </span>
                        </div>
                    @endforeach
                @else
                    <x-alert class="alert-info" message="No articles to display." />
                @endif
            </div>
        </div>
    </x-container>
</x-layout>