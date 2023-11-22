<x-layout :meta="$meta">
    <x-container>
        <h1>Categories</h1>
        <h2>Browse our news articles by category.</h2>
        <table>
            <thead>
                <tr>
                    <th>Hex</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->hex}}</td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->image}}</td>
                        <td>{{$category->created}}</td>
                        <td>{{$category->updated}}</td>
                        <td>{{$category->status}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="category-grid">
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
        </div> --}}
        {{$categories->links()}}
    </x-container>
</x-layout>

<x-layout>
    <x-container>
        <h1>Manage categoris</h1>
        <h2>Manage the categories for the site.</h2>
        <div class="btn-row">
            <a href="/categories/create" class="btn-success">
                Create a new category
            </a>
        </div>
        
        @if(count($categories) > 0)
            <div class="articles-grid mt-10">
                @foreach($categories as $category)
                    <div class="article-card-sm">
                        <div>
                            <a href="/categories/{{$category->hex}}">
                                <img src="{{$category->getImage('tn')}}">
                            </a>
                            <a href="/categories/{{$category->hex}}">
                                <span class="title">
                                    {{$category->name}}
                                </span>
                            </a>
                            <span class="date">{{showDateTime($category->created_at)}}</span>
                        </div>
                        <div class="flex gap-1 pt-6">
                            @if(verifyPermissions($category))
                                <a href="/categories/{{$category->hex}}/edit" class="btn-success-xs">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                <a href="/categories/{{$category->hex}}/image" class="btn-info-xs">
                                    <i class="fa fa-image"></i>
                                    Change image
                                </a>
                                <a href="/categories/{{$category->hex}}/confirm-delete" class="btn-danger-xs">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <x-alert class="alert-info" message="No categories to display." />
        @endif

        {{$categories->links()}}
    </x-container>
</x-layout>