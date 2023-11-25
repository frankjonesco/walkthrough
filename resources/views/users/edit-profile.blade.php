<x-page :page-headings='$page_headings'>
    <x-card-form-medium>
        
        <form action="/profile/update" method="POST" class="flex flex-col">
            @csrf
            {{-- First name --}}
            <div class="form-element">
                <label for="first_name">First name</label>
                <input type="text" name="first_name" value="{{old('first_name') ?: $user->first_name}}">

                @error('first_name')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Last name --}}
            <div class="form-element">
                <label for="last_name">Last name</label>
                <input type="text" name="last_name" value="{{old('last_name') ?: $user->last_name}}">

                @error('last_name')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-element">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('email') ?: $user->email}}">

                @error('email')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <button type="submit" class="btn-success">Save changes</button>
        </form>
    </x-card-form-medium>
</x-page>
