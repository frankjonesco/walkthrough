<footer class="bg-black text-white mt-auto m">
    <x-container>
        <div class="flex justify-between items-center py-10">
            <div>
                <span class="font-bold text-xl">
                    <a href="/" class="text-white transition-all duration-150 ease-in-out hover:-translate-y-1 inline-block">
                        {{config('app.name')}}
                    </a>
                </span>
                <span class="font-thin">
                    &copy; {{date('Y')}}
                </span>
            </div>
            <ul class="flex gap-5 text-sm font-light font-roboto">
                <li>
                    <a href="/terms" class="text-white hover:underline underline-offset-8">
                        Terms
                    </a>
                </li>
                <li>
                    <a href="/privacy" class="text-white hover:underline underline-offset-8">
                        Privacy
                    </a>
                </li>
        </div>
    </x-container>
</footer>