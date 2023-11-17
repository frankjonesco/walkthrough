<x-layout>
    <x-container>
        <h1>Crop image</h1>
        <h2>Drag your mouse across the image to select the crop area and click Crop image.</h2>
        <div class="flex gap-12">
            <div class="w-2/3 bg-yellow-500">
                <img id="image" src="{{$category->getImage()}}" alt="" style="height:500px;" class="w-1/3">
            </div>
            <div class="w-1/3">
                <form action="{{url('categories/'.$category->hex.'/image/render')}}" method="POST" class="flex justify-between">
                    @csrf
                    <input type="hidden" name="x" id="imgX">
                    <input type="hidden" name="y" id="imgY">
                    <input type="hidden" name="w" id="imgW">
                    <input type="hidden" name="h" id="imgH">
    
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full">
                            <button type="submit" class="btn btn-success whitespace-nowrap w-full mb-3">
                                <i class="fa-solid fa-crop mr-1.5"></i> 
                                Crop image
                            </button>
                        </div>
                        <div class="w-full">
                            <a href="/categories/{{$category->hex}}/image">
                                <button type="button" class="btn btn-danger whitespace-nowrap !w-full">
                                    <i class="fa-solid fa-arrow-left mr-1.5"></i> 
                                    Change image
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>

    <script>
        const image = document.getElementById('image');
        const cropper = new Cropper(image, {
            viewMode: 2,
            aspectRatio: 760 / 428,
            autoCropArea: 0.8,
            movable: false,
            scalable: false,
            zoomable: false,
            crop(event) {
                document.getElementById('imgX').value=event.detail.x;
                document.getElementById('imgY').value=event.detail.y;
                document.getElementById('imgW').value=event.detail.width;
                document.getElementById('imgH').value=event.detail.height;
                // console.log(event.detail.x);
                // console.log(event.detail.y);
                // console.log(event.detail.width);
                // console.log(event.detail.height);
                // console.log(event.detail.rotate);
                // console.log(event.detail.scaleX);
                // console.log(event.detail.scaleY);
            },
        });
    </script>
</x-layout>

    


