<x-layout>
    <x-container>
        <h1>Manage categories</h1>
        <h2>Here you can manage the different news categories.</h2>
        <div class="btn-row">
            <a href="/categories/create" class="btn-success">
                Create a new category
            </a>
        </div>
        <div class="border border-gray-200 p-8 rounded-xl">
            <table class="content-table">
                <thead>
                    <tr>
                        <th class="text-center">Hex</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Status</th>
                        @if(verifyPermissions())
                            <th class="flex justify-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 0;
                    @endphp
                    @foreach ($categories as $category)
                        @php
                        $count++;
                        @endphp
                    
                        <tr class="{{($count % 2 == 1) ?: 'bg-yellow-50'}}">
                            <td>{{$category->hex}}</td>
                            <td>
                                <div class="flex items-center">
                                    <img src="{{$category->getImage('tn')}}" class="h-6 mr-2">
                                    <span class="block">
                                        {{$category->name}}
                                    </span>
                                </div>
                            </td>
                            <td>{{$category->slug}}</td>
                            <td>{{showDateTime($category->created_at, 'short')}}</td>
                            <td>{{showDateTime($category->updated_at, 'short')}}</td>
                            <td>{!!showColoredStatus($category->status)!!}</td>
                            @if(verifyPermissions($category))
                                <td>
                                    <div class="flex gap-2 items-end justify-end">
                                        <a href="/categories/{{$category->hex}}/edit" class="btn-success-xs">
                                            <i class="fa-solid fa-pencil"></i>
                                            Edit text
                                        </a>
                                        <a href="/categories/{{$category->hex}}/image" class="btn-info-xs">
                                            <i class="fa-regular fa-image"></i>
                                            Change image
                                        </a>
                                        <a href="/categories/{{$category->hex}}/confirm-delete" class="btn-danger-xs">
                                            <i class="fa-regular fa-trash-can"></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$categories->links()}}
    </x-container>
</x-layout>