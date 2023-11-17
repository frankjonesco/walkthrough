<x-layout>
    <x-container>
        <h1>{{$article->title}}</h1>
        <h2>{{$article->caption}}</h2>

        <div class="flex border-t border-t-gray-200 pt-8 px-3">

            {{-- Left colun --}}
            <div class="w-2/3">
                <img src="{{$article->getImage()}}">
                <div class="border-t border-t-gray-200 mt-6 pt-3">{!!nl2p($article->body)!!}</div>
            </div>

            {{-- Right column --}}
            <div class="w-1/3 !font-roboto">
                <div class="w-[80%] ml-auto mr-6">
                    {{-- Share icon first row --}}
                    <div class="flex gap-4 mx-auto w-fit pt-10">
                        <a id="shareFacebook" href="https://www.facebook.com/sharer/sharer.php?u=https://truecrimemetrix.test/articles/NvsyCaKdB9B&amp;display=popup" target="_blank" rel="Share on Facebook" class="share-link hover:bg-[#3b5998] hover:text-white animate-150-in">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a id="shareTwitter" href="#" rel="Share on Twitter" class="share-link hover:bg-[#1da1f2] hover:text-white animate-150-in">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a id="shareEmail" href="#" rel="Share via email" class="share-link hover:bg-gray-600 hover:text-white animate-150-in">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a id="expandShareOptions" href="#" rel="More search options" class="share-link hover:bg-gray-900 hover:text-white animate-150-in">
                            <i class="fas fa-ellipsis-h"></i>
                        </a>
                    </div>

                    {{-- Share icons second row --}}
                    <div id="shareSecondRow" class="gap-4 mx-auto w-fit hidden mt-6">
                        <a id="shareFacebook" href="#" rel="Share on Whatsapp" class="share-link hover:bg-[#25d366] hover:text-white animate-150-in">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a id="shareEmail" href="#" rel="Share on Reddit" class="share-link hover:bg-[#ff4500] hover:text-white animate-150-in">
                            <i class="fab fa-reddit"></i>
                        </a>
                        <a id="expandShareOptions" href="#" rel="Share on Flipboard" class="share-link hover:bg-[#e12828] hover:text-white animate-150-in">
                            <i class="fab fa-flipboard"></i>
                        </a>
                    </div>

                    {{-- Views --}}
                    <div class="border-b text-center pt-6 pb-6">
                        <span class="font-bold">
                            {{$article->views}}
                        </span>
                        <span class="font-light">Views</span>
                    </div>

                    {{-- Author --}}
                    <div class="border-b py-6 text-center">
                        <img src="{{asset('images/default-profile-pic.jpeg')}}" class="w-1/6 pb-5 mx-auto">
                        <div class="text-sm">
                            <span class="font-light">By</span>
                            <span class="font-bold">
                                <a href="#" class="!undlerline underline-offset-2 text-gray-900">
                                    {{$article->user->fullName()}}
                                </a>
                            </span>
                        </div>
                    </div>

                    {{-- Published date --}}
                    <div class="py-6 text-center text-sm font-roboto">
                        <span class="font-bold">
                            Published
                        </span>
                        <span class="font-light">
                            {{showDateTime($article->created_at)}}
                        </span>
                    </div>
                </div>
            </div> 
        </div>
    </x-container>

    <script>

        // Constants
        const expandShareOptions = document.querySelector('#expandShareOptions');
        const shareSecondRow = document.querySelector('#shareSecondRow');

        // Event listeners
        expandShareOptions.addEventListener('click', function(e){
            shareSecondRow.classList.toggle('hidden');
            shareSecondRow.classList.toggle('flex');
            e.preventDefault();
        });
        
    </script>
</x-layout>