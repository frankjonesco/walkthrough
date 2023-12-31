<x-page :page-headings="$page_headings">
    <x-card-form-medium>
        <form id="form" action="/categories/{{$category->hex}}/image/upload" method="POST" enctype="multipart/form-data" class="flex justify-center">
            @csrf
            
            <div class="form-element flex flex-col">
                <button id="uploadButton" type="button" class="btn-success" onclick="document.getElementById('image').click()" >Select an image</button>
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
    </x-card-form-medium>
</x-page>