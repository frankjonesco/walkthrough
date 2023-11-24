<x-layout>
    <x-container>
        <div class="breadcrums mx-auto w-fit text-sm">
            <span>
                <a href="/articles" class="text-gray-900">
                    News
                </a>
            </span>
            <span>></span>
            <span>
                <a href="/categories/{{$article->category->hex}}" class="font-bold no-underline underline-offset-2">
                    {{$article->category->name}}
                </a>
            </span>
        </div>
        <x-page-headings :page-heading="getPageHeading('main', $article)" :page-subheading="getPageHeading('sub', $article)" />

        <div class="flex border-t border-t-gray-200 pt-8 px-3">

            {{-- Left column --}}
            <div class="w-2/3">
                <img src="{{$article->getImage()}}" class="w-full aspect-video">

                @if($article->image_caption || $article->image_copyright)
                    <div class="flex justify-between text-sm text-gray-400 mt-3">
                        <span>{{$article->image_caption}}</span>
                        @if($article->image_copyright && $article->image_copyright_link)
                            <span>&copy; <a href="{{$article->image_copyright_link}}" target="_blank" class="text-inherit">{{$article->image_copyright}}</a></span>
                        @elseif($article->image_copyright)
                            <span>&copy; {{$article->image_copyright}}</span>
                        @endif
                    </div>                    
                @endif
                
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
                            {{formatNumber($article->views)}}
                        </span>
                        <span class="font-light">Views</span>
                    </div>

                    {{-- Author --}}
                    <div class="border-b py-6 text-center">
                        <img src="{{$article->user->getImage('tn')}}" class="w-24 mx-auto border-4 border-red-100 p-1 rounded-full mb-5">
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

                    {{-- Category label --}}
                    <div class="pb-6 text-center text-sm font-roboto">
                        <span class="font-bold">
                            Category
                        </span>
                        <span class="font-light">
                            <a href="/categories/{{$article->category->hex}}">
                                {{$article->category->name}}
                            </a>
                        </span>
                    </div>

                    {{-- Tags--}}
                    <div class="text-center text-sm font-roboto">
                        <span class="font-light">
                            @foreach ($article->splitTags() as $tag)
                                <a href="/tags/{{trim($tag)}}" class="px-2.5 py-1 bg-yellow-200 rounded-lg mr-1 text-gray-900 transition-all duration-150 ease-in-out hover:-translate-y-0.5 hover:bg-amber-200 inline-block">{{trim($tag)}}</a>
                            @endforeach
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