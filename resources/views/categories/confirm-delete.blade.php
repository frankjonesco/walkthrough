<x-page :page-headings="$page_headings">
    <x-card-form-medium>    
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
            <a href="{{ url()->previous() }}" class="btn-danger">Cancel</a>
        </form>
    </x-card-form-medium>
</x-page>