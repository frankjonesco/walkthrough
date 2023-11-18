<x-layout>
    <x-container>
        <h1>Edit article image</h1>
        <h2>Edit details or change article image.</h2>
        <div class="form-element flex flex-col w-3/4 mx-auto">
            <form id="form" action="/articles/{{$article->hex}}/image/upload" method="POST" enctype="multipart/form-data" class="flex justify-center">
                @csrf
                <span class="inline-block mx-auto mb-6">
                    <button id="uploadButton" type="button" class="btn-success mx-auto" onclick="document.getElementById('image').click()" >Change image</button>
                    <input aria-describedby="image_help" id="image" name="image" type="file" class="opacity-0 w-0">
                    @error('image')
                        <p class="text-error">{{$message}}</p>
                    @enderror
                </span>
            </form>
            <img src="{{$article->getImage()}}" class="mb-10">
            <form action="/articles/{{$article->hex}}/image/save-details" method="POST" class="border-t pt-8">
                @csrf
                <div class="form-element">
                    <label for="image_caption">Image caption</label>
                    <input type="text" name="image_caption" placeholder="Image caption" value="{{old('image_caption') ?: $article->image_caption}}">
                </div>
                <div class="form-element">
                    <label for="image_copyright">Image copyright</label>
                    <input type="text" name="image_copyright" placeholder="Image copyright" value="{{old('image_copyright') ?: $article->image_copyright}}">
                </div>
                <button type="submit" class="btn-success block mx-auto">Save changes</button>
            </form>
        </div>
        <script>
            document.getElementById("image").onchange = function() {
                document.getElementById("form").submit();
            };
        </script>
    </x-container>
</x-layout>