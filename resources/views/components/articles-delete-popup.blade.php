<div class="absolute top-0 left-0 w-screen h-screen bg-black bg-opacity-50 flex justify-center items-center">
    <div class="w-[600px]  !bg-white opacity-100 rounded p-10 flex flex-col items-center">
        <h2>Are you sure you want to delete this?</h2>
        <p class="font-bold">{{$article->title}}</p>
        <img src="{{$article->getImage('tn')}}" class="w-[50%]">
        <ul class="flex gap-3 my-10">
            <li>
                <form action="/articles/{{$article->hex}}/delete/confirm" method="POST">
                    @csrf
                    <a href="#" onclick="this.parentNode.submit()" class="btn-success">Yes, delete it</a>
                </form>
            </li>
            <li>
                <a href="" class="btn-danger">Cancel</a>
            </li>
        </ul>
    </div>
</div>