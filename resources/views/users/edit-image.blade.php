<x-layout>
    <x-container>
        <h1>Edit profile picture</h1>
        <h2>Click the button to select an image.</h2>
        <form id="form" action="/profile/image/upload" method="POST" enctype="multipart/form-data" class="flex justify-center">
            @csrf
            
            <div class="form-element flex flex-col">
                <button id="uploadButton" type="button" class="btn-success" onclick="document.getElementById('image').click()" >
                    Select an image
                </button>
                <input aria-describedby="image_help" id="image" name="image" type="file" class="opacity-0">

                @error('image')
                    <p class="text-error">{{$message}}</p>
                @enderror
            </div>
        </form>
        <script>
            document.getElementById("image").onchange = function() {
                document.getElementById("form").submit();
            };
        </script>
    </x-container>
</x-layout>