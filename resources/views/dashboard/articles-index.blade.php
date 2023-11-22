<x-layout>
    <x-container>
        <h1>Manage news articles</h1>
        <h2>Here you can manage the different news articles.</h2>
        <div class="btn-row">
            <a href="/articles/create" class="btn-success">
                Create a new article
            </a>
        </div>
        <div class="border border-gray-200 p-8 rounded-xl">
            <table class="content-table">
                <thead>
                    <tr>
                        <th class="text-center">Hex</th>
                        <th>Name</th>
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
            
                    @foreach($articles as $article)
                        @php
                        $count++;
                        @endphp
                        <tr class="{{($count % 2 == 1) ?: 'bg-yellow-50'}}">
                            <td>{{$article->hex}}</td>
                            <td>
                                <div class="flex items-center">
                                    <img src="{{$article->getImage('tn')}}" class="h-6 mr-2">
                                    <span class="block">
                                        {{truncate($article->title, 40)}}
                                    </span>
                                </div>
                            </td>
                            <td>{{showDateTime($article->created_at, 'short')}}</td>
                            <td>{{showDateTime($article->updated_at, 'short')}}</td>
                            <td>{!!showColoredStatus($article->status)!!}</td>
                            @if(verifyPermissions($article))
                                <td>
                                    <div class="flex gap-2 items-end justify-end">
                                        <a href="/articles/{{$article->hex}}/edit" class="btn-success-xs">
                                            <i class="fa-solid fa-pencil"></i>
                                            Edit text
                                        </a>
                                        <a href="/articles/{{$article->hex}}/image" class="btn-info-xs">
                                            <i class="fa-regular fa-image"></i>
                                            Change image
                                        </a>
                                        <a href="/articles/{{$article->hex}}/confirm-delete" class="btn-danger-xs">
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

        {{$articles->links()}}
    </x-container>
</x-layout>