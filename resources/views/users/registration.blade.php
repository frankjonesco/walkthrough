<x-layout>
    <x-container>
        <x-card-form-thin>
            <h1>Sign up</h1>
            <h2>Create an account on {{config('app.name')}}</h2>
            <form action="/users/store" method="POST" class="flex flex-col">
                @csrf
                {{-- First name --}}
                <div class="form-element">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" value="{{old('first_name')}}">

                    @error('first_name')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror

                </div>

                {{-- Last name --}}
                <div class="form-element">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" value="{{old('last_name')}}">

                    @error('last_name')
                        <p class="form-error">
                            {{$message}}
                        </p>
                    @enderror
                    
                </div>

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

                {{-- Gender --}}
                <div class="form-element">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option disabled selected>Please select...</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    @error('gender')
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
                
                {{-- Password confirmation --}}
                <div class="form-element">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation">
                </div>

                <button type="submit" class="btn-success">Create an account</button>

                <p>
                    Already have an account?
                    <br>
                    <a href="/login">Log in</a>
                </p>
                
            </x-card-form-thin>
        </div> 
    </x-container>
</x-layout>