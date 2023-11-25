<x-page :page-headings='$page_headings'>
    <x-card-form-medium>
        <form action="/profile/update-password" method="POST" class="flex flex-col">
            @csrf
            {{-- Old password --}}
            <div class="form-element">
                <label for="old_password">Old password</label>
                <input type="password" name="old_password" autofocus>

                @error('old_password')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- New password --}}
            <div class="form-element">
                <label for="password">New password</label>
                <input type="password" name="password">

                @error('password')
                    <p class="form-error">
                        {{$message}}
                    </p>
                @enderror
            </div>

            {{-- Confirm new password --}}
            <div class="form-element">
                <label for="password_confirmation">Confirm new password</label>
                <input type="password" name="password_confirmation">
            </div>
            <button type="submit" class="btn-success">Save password</button>
        </form>
    </x-card-form-medium>
</x-page>
