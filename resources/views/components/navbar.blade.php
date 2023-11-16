{{-- Fixed navbar --}}
<nav id="topNav">
    <x-container>
        <ul>
            <li>
                <a href="#" id="openMenuIcon">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </li>
            <li>
                <a href="/" class="site-logo">
                    {{config('app.name')}}
                </a>
            </li>
            <li>
                <a href="#" id="toggleSearchIcon">
                    <i class="fa-solid fa-search"></i>
                </a>
            </li>
        </ul>
    </x-container>
</nav>


{{-- Slide menu --}}
<div id="slideMenu" class="-left-1/4">
    <div class="menu-heading">Menu</div>
    <ul>
        <li>
            <a href="/">
                Home
            </a>
        </li>
        <li>
            <a href="/articles">
                News articles
            </a>
        </li>
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
</div>


{{-- Search slide --}}
<div id="searchSlide" class="-translate-y-20">
    <x-container>
        <form action="#" method="POST">
            @csrf
            <input type="text" name="search" id="searchField" placeholder="Search">
        </form>
    </x-container>
</div>




{{-- Blackout --}}
<div id="blackout" class="hidden"></div>

<script>

    // CONSTANTS
    const openMenuIcon = document.querySelector('#openMenuIcon');
    const slideMenu = document.querySelector('#slideMenu');
    const toggleSearchIcon = document.querySelector('#toggleSearchIcon');
    const searchSlide = document.querySelector('#searchSlide');
    const blackout = document.querySelector('#blackout');
    

    // LISTENERS

    // Click to open menu
    openMenuIcon.addEventListener('click', function (e) {
        e.preventDefault();
        showBlackout(); 
        if(slideMenu.classList.contains('-left-1/4')){
            showMenu();
            hideSearch();
        }else{
            hideMenu();
            hideSearch();
        }
    });

    // Click to open search slide
    toggleSearchIcon.addEventListener('click', function (e) {
        e.preventDefault();
        showBlackout(); 
        if(searchSlide.classList.contains('-translate-y-20')){
            hideMenu();
            showSearch();
        }else{
            hideMenu();
            hideSearch();
        }
    });

    // Click to close blackout
    blackout.addEventListener('click', function (e) {
        e.preventDefault();
        hideMenu();
        hideSearch();
        hideBlackout();
    });


    // FUNCTIONS

    // Show menu
    function showMenu(){
        slideMenu.classList.remove('-left-1/4');
        slideMenu.classList.add('left-0');   
        hideSearch();        
    }

    // Hide menu
    function hideMenu(){
        slideMenu.classList.remove('left-0');
        slideMenu.classList.add('-left-1/4');
    }

    // Show menu
    function showSearch(){
        searchSlide.classList.remove('-translate-y-20');
        searchField.focus();
    }

    // Hide search
    function hideSearch(){
        searchSlide.classList.add('-translate-y-20');
    }

    // Show blackout
    function hideBlackout(){
        if(blackout.classList.contains('hidden') === false){
            blackout.classList.add('hidden');
        }
    }

    // Hide blackout
    function showBlackout(){
        if(blackout.classList.contains('hidden') === true){
            blackout.classList.remove('hidden');
        }
    }
</script>



{{-- 

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

        <li>
            <a href="/articles">
                News articles
            </a>
        </li>

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
</nav> --}}