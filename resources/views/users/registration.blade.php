<x-page :page-headings='$page_headings'>
        <x-card-form-medium>
            <form action="/users/store" method="POST" class="grid grid-cols-2 gap-10">
                @csrf
                {{-- First name --}}
                <div class="form-element">
                    <label for="first_name">First name</label>
                    <input type="text" name="first_name" placeholder="Your first name" value="{{old('first_name')}}">
                    <x-form-error element="first_name" />
                </div>

                {{-- Last name --}}
                <div class="form-element">
                    <label for="last_name">Last name</label>
                    <input type="text" name="last_name" placeholder="Your last name" value="{{old('last_name')}}">
                    <x-form-error element="last_name" />
                </div>

                {{-- Email --}}
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Your email address" value="{{old('email')}}">
                    <x-form-error element="email" />
                </div>

                {{-- Gender --}}
                <div class="form-element">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" required>
                        <option value="" disabled selected hidden>Please select...</option>
                        <option value="male" {{old('gender') === 'male' ? 'selected' : null}}>Male</option>
                        <option value="female" {{old('gender') === 'female' ? 'selected' : null}}>Female</option>
                    </select>
                    <x-form-error element="gender" />
                </div>
                
                {{-- Password --}}
                <div class="form-element">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password">
                    <x-form-error element="password" />
                </div>
                
                {{-- Password confirmation --}}
                <div class="form-element">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm password">
                </div>

                <div class="col-span-2 text-center py-2 mb-10">
                    <button type="submit" class="btn-success mb-6">Create an account</button>
                    <p class="text-sm !mb-0">
                        Already have an account?
                        <br>
                        <a href="/login">Log in</a>
                    </p>
                </div>
            </form>                
        </x-card-form-medium>
    </div> 
</x-page>