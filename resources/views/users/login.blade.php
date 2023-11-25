<x-page :page-headings='$page_headings'>
    <x-card-form-thin>
        <form action="/users/authenticate" method="POST" class="grid grid-cols-1 gap-10">
            @csrf
            {{-- Email --}}
            <div class="form-element">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('email')}}">
                <x-form-error element="email" />
            </div>
            {{-- Password --}}
            <div class="form-element">
                <label for="password">Password</label>
                <input type="password" name="password">
                <x-form-error element="password" />
            </div>
            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="btn-success">Log in</button>
                <p>
                    Don't have an account yet?
                    <br>
                    <a href="/signup">
                        Sign up
                    </a>
                </p>
            </div>
        </form>
    </x-card-form-thin>
</x-page>