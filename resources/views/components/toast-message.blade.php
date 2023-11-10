@if(session()->has('message'))
    <div class="">
        <div 
            id="toast-success" 
            class="opacity-0 fixed left-1/2 -translate-x-1/2 top-1/4 translate-y-full bg-lime-400 w-min-content p-8 rounded-sm transform transition-all duration-500 ease-out z-50 border-2 shadow-md border-gray-900" data-replace="{ 'opacity-0': 'opacity-100', 'translate-y-full': '-translate-y-1/2' }" role="alert" 
        >
            <div 
                class="mx-3 !text-3xl font-black text-center text-gray-900"
            >
                {{session('message')}}
                @if(session()->has('message_part_two'))
                    <br>
                    {{session('message_part_two')}}
                @endif
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function(){
        setTimeout(function(){
            var replacers = document.querySelectorAll('[data-replace]');
            for(var i=0; i<replacers.length; i++){
                let replaceClasses = JSON.parse(replacers[i].dataset.replace.replace(/'/g, '"'));
                Object.keys(replaceClasses).forEach(function(key) {
                    replacers[i].classList.remove(key);
                    replacers[i].classList.add(replaceClasses[key]);
                });
            }
        }, 0 /* 0.001 seconds */ );
        setTimeout(function(){
            var replacers = document.querySelectorAll('[data-replace]');
            for(var i=0; i<replacers.length; i++){
                let replaceClasses = JSON.parse(replacers[i].dataset.replace.replace(/'/g, '"'));
                Object.keys(replaceClasses).forEach(function(key) {
                    replacers[i].classList.add(key);
                    replacers[i].classList.remove(replaceClasses[key]);
                });
            }
        }, 2000 /* 3.000 seconds */ );
    });
</script>