<x-layout>
    <x-container>
        <h1>Categories</h1>
        <h2>Browse our news articles by category.</h2>
        <div class="category-grid">
            @foreach ($categories as $category)
                <div class="category-card-sm">
                    <a href="/categories/{{$category->hex}}/{{$category->slug}}">
                        <img src="{{$category->getImage('tn')}}">
                    </a>
                    <a href="/categories/{{$category->hex}}/{{$category->slug}}">
                        <span class="title">
                            {{$category->name}}
                        </span>
                    </a>
                    <span class="article-count">
                        <span class="font-bold">
                            Articles:
                        </span>
                        {{count($category->articles)}}
                    </span>
                </div>
            @endforeach
        </div>
        {{$categories->links()}}
    </x-container>
</x-layout>