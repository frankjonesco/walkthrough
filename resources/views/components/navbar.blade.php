{{-- Fixed navbar --}}
<nav id="topNav">
    <x-container>
        <ul>
            <li class="w-1/4">
                <a href="#" id="openMenuIcon">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </li>
            <li class="w-1/2 text-center font-bold">
                <a href="/" class="site-logo">
                    {{config('app.name')}}
                </a>
            </li>
            <li class="w-1/4 justify-end flex gap-6">
                @if(verifyPermissions())
                    @auth
                        <a href="/articles/create" class="!text-green-400">
                            <i class="fa-solid fa-circle-plus"></i>
                        </a>
                        <a href="/categories/create" class="!text-blue-400">
                            <i class="fa-solid fa-folder-plus"></i>
                        </a>
                        <a href="/profile" class="!text-purple-400">
                            <i class="fa-solid fa-user-circle"></i>
                        </a>
                        <a href="/dashboard" class="!text-red-400 text-md">
                            <i class="fa-solid fa-dashboard"></i>
                        </a>
                        
                    @endauth
                @endif
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
            <a href="/categories">
                Categories
            </a>
        </li>
        <li>
            <a href="/articles">
                News articles
            </a>
        </li>
        <li>
            <a href="/contact">
                Contact
            </a>
        </li>
        @auth
            <li>
                <a href="/dashboard">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="/profile">
                    Profile
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
        <form action="/search" method="POST">
            @csrf
            <input type="text" name="search_term" id="searchField" placeholder="Search">
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
