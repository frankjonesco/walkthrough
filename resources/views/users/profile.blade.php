<x-layout>
    <x-container>
        <h1>Profile</h1>
        <div class="grid grid-cols-2">
            <div class="">
                <img src="{{$user->getImage()}}">
            </div>
        </div>
    </x-container>
</x-layout>