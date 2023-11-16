<x-container>
    <div class="bg-slate-200 border-2 border-slate-400 rounde text-center p-10 w-full">
        <h2>Welcom to the {{config('app.name')}} blog</h2>
        
        <ul class="flex justify-center gap-3 my-6">
            <li>
                <a href="/about" class="btn-success">More info</a>
            </li>
            <li>
                <a href="/contact" class="btn-default">Contact us</a>
            </li>
        </ul>
    </div>
</x-container> 