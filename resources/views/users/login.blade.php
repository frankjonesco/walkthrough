<x-layout>
    <x-container>
        <x-card-form-thin>
            <h1>Log in</h1>
            <h2>Log in to your account</h2>
            <form action="/users/authenticate" method="POST" class="flex flex-col">
                @csrf
                {{-- Email --}}
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{old('email')}}">

                    @error('email')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror

                </div>
                
                {{-- Password --}}
                <div class="form-element">
                    <label for="password">Password</label>
                    <input type="password" name="password">

                    @error('password')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror

                </div>

                <button type="submit" class="btn-success">Log in</button>

                <p>Don't have an account yet?<br><a href="/signup">Sign up</a></p>
            </x-card-form-thin>
        </div> 
    </x-container>
</x-layout>