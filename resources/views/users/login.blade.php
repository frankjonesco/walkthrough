<x-layout>
    <x-container>
        <x-card-form-thin>
            <h1>Log in</h1>
            <h2>Log in to your account</h2>
            <form action="/register" class="flex flex-col">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email">
                
                <label for="password">Password</label>
                <input type="password" name="password">

                <button type="submit" class="btn btn-green">Log in</button>

                <p>Don't have an account yet?<br><a href="/signup">Sign up</a></p>
            </x-card-form-thin>
        </div> 
    </x-container>
</x-layout>