<x-layout>
    <x-container>

        <div class="w-1/3 mx-auto bg-gray-100 p-10 my-10">
            <h1 class="py-0">Sign up</h1>
            <h2>Create an account on {{config('app.name')}}</h2>
            <form action="/register" class="flex flex-col">
                @csrf
                <label for="name">Name</label>
                <input type="text" name="name">

                <label for="email">Email</label>
                <input type="email" name="email">
                
                <label for="password">Password</label>
                <input type="password" name="password">
                
                <label for="password">Confirm password</label>
                <input type="password" name="confirm_password">

                <button type="submit" class="btn btn-green">Create an account</button>

                <p class="text-center mt-10">Already have an account?<br><a href="/login">Log in</a></p>
            </form>
        </div> 
    </x-container>
</x-layout>