<x-layout>
    <x-container>
        <h1>Dashboard</h1>
        <h2>Manage the different areas of the {{config('app.name')}} project</h2>
        <div class="grid grid-cols-3 gap-6 border-t border-t-200 pt-8 px-3">
            @foreach ($buttons as $button)
                @if(auth()->user()->user_type_id >= $button['required_user_type'])
                    <div class="flex justify-center items-center">
                        <a href="{{$button['link']}}" class="bg-{{$button['color']}}-300 p-20 py-6 rounded-xl border-[0.4rem] border-{{$button['color']}}-400 shadow-lg text-center text-white transition-all duration-300 ease-in-out hover:-translate-y-2 hover:shadow-xl">
                            <i class="fa-regular fa-{{$button['icon']}} text-8xl"></i>
                            <span class="block pt-6 font-bold text-xl font-roboto">{{$button['label']}}</span>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </x-container>    
</x-layout>