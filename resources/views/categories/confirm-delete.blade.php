<x-layout>
    <x-container>
        <h1>Confirm delete</h1>
        <h2>Are you sure you want to delete this category?</h2>
        <div class="w-1/2 bg-gray-100 border border-gray-200 mx-auto p-6 rounded text-center">
            
            <div class="bg-white mb-6 border border-gray-200 flex gap-3 p-3">
                <img src="{{$category->getImage('tn')}}" class="w-1/4">
                <div class="flex flex-col items-start">
                    <span class="font-bold text-lg">{{$category->name}}</span>
                    <span class="text-sm">{{showDateTime($category->created_at)}}</span>
                </div>
            </div>
            <form action="/categories/destroy" method="POST">
                @csrf
                <input type="hidden" name="hex" value="{{$category->hex}}">
                <button type="submit" class="btn-success">Yes, delete this</button>
                <button type="button" class="btn-danger">Cancel</button>
            </form>
        </div>
    </x-container>
</x-layout>