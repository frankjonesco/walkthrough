<x-layout>
    <x-container>
        <x-card-form-thin>
            <h1>Sign up</h1>
            <h2>Create an account on {{config('app.name')}}</h2>
            <form action="/register" method="POST" class="flex flex-col">
                @csrf
                <label for="first_name">First name</label>
                <input type="text" name="first_name">

                <label for="last_name">Last name</label>
                <input type="text" name="last_name">

                <label for="email">Email</label>
                <input type="email" name="email">
                
                <label for="password">Password</label>
                <input type="password" name="password">
                
                <label for="password">Confirm password</label>
                <input type="password" name="confirm_password">

                <button type="submit" class="btn btn-green">Create an account</button>

                <p>Already have an account?<br><a href="/login">Log in</a></p>
            </x-card-form-thin>
        </div> 
    </x-container>
</x-layout>