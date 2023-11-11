<nav id="topNav">
    <div class="font-bold text-3xl">
        <a href="/">
            {{config('app.name')}}
        </a>
    </div>
    <ul class="flex gap-5">
        <li>
            <a href="/">
                Home
            </a>
        </li>
        {{-- <li>
            <a href="/about">
                About
            </a>
        </li> --}}
        <li>
            <a href="/articles">
                News articles
            </a>
        </li>
        {{-- <li>
            <a href="/contact">
                Contact
            </a>
        </li> --}}

        @auth
            <li>
                <a href="/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <a href="#" onclick="this.parentNode.submit()">Logout</a>
                </form>
            </li>
        @else
            <li>
                <a href="/login">
                    Login
                </a>
            </li>
            <li>
                <a href="/signup">
                    Sign up
                </a>
            </li>
        @endauth
    </ul>
</nav>