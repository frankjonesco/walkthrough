<x-layout>
    <x-container>
        <h1>Confirm delete</h1>
        <div class="w-1/2 bg-gray-100 border border-gray-200 mx-auto p-6 rounded text-center">
            <h2>Are you sure you want to delete this article?</h2>
            <div class="bg-white mb-6 border border-gray-200 flex gap-3 p-3">
                <img src="{{$article->getImage('tn')}}" class="w-1/4">
                <div class="flex flex-col items-start">
                    <span class="font-bold text-lg">{{$article->title}}</span>
                    <span class="text-sm">{{showDateTime($article->created_at)}}</span>
                </div>
            </div>
            <form action="/articles/destroy" method="POST">
                @csrf
                <input type="hidden" name="hex" value="{{$article->hex}}">
                <button type="submit" class="btn-success">Yes, delete this</button>
                <button type="button" class="btn-danger">Cancel</button>
            </form>
        </div>
    </x-container>
</x-layout>