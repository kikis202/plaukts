@push('styles')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
@endpush

<header>
    <div class="bg-overlay">
        <nav id="top-menu" class="menu">
            <ul class="parent-menu">
                @auth
                <li class="upper-menu-items" id="page-name"><a href="">Grāmatu plaukts<sup>TM</sup></a></li>
                <li class="upper-menu-items"><a href="{{ url('books') }}">Meklēt grāmatu</a></li>
                <li class="upper-menu-items"><a href="{{ url('u/'.auth()->user()->username.'/plaukti') }}">Mani plaukti</a></li>
                <li class="upper-menu-items"><a href="{{ url('profile/'.auth()->user()->username) }}">Mans profils</a></li>
                <li class="upper-menu-items" id="logout">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </li>
                @else
                <li class="upper-menu-items" id="page-name"><a href="">Grāmatu plaukts<sup>TM</sup></a></li>
                <li class="upper-menu-items"><a href="">Meklēt grāmatu</a></li>
                <li class="upper-menu-items"><a href="">Mani plaukti</a></li>
                <li class="upper-menu-items"><a href="">Mans profils</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>