<header class="header">
    <div class="container">
        <div class="header__content">
            <ul class="header__list">
                <li>
                    <a class="header__list-item header__list-item--show" href="/"><img draggable="false" class="header__logo" src="{{asset('images/stage-tracker.png')}}" alt=""></a>
                </li>
                @auth()
                    <li><a class="header__list-item" href="{{route('home')}}">Uren indienen</a></li>
                    <li><a class="header__list-item" href="{{route('overzicht')}}">Overzicht</a></li>
                @endauth
            </ul>
            <ul class="header__list header__list--right">
                @auth()
                    <li><a class="header__list-item" href="{{route('profiel')}}">Profiel</a></li>

                    <li>
                        <a class="header__list-item m-0" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a>
                    </li>

                    <form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">
                        @csrf
                    </form>

                @endauth
                @guest()
                    <li><a class="header__list-item" href="{{route('login')}}">Inloggen</a></li>
                @endguest
                <div class="header__hamburger-wrap">
                    <div class="header__hamburger">
                    </div>
                </div>
            </ul>
            <div class="header__hamburger-menu">
                @auth()
                    <ul class="header__list header__list--small">
                        <li><a class="header__list-item header__list-item--small" href="{{route('home')}}">Uren indienen</a></li>
                        <li><a class="header__list-item header__list-item--small" href="{{route('overzicht')}}">Overzicht</a></li>
                    </ul>
                @endauth
                <ul class="header__list header__list--small">
                    @auth()
                        <li><a class="header__list-item header__list-item--small" href="{{route('profiel')}}">Profiel</a></li>
                        <li><a class="header__list-item header__list-item--small" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</a></li>
                    @endauth
                    @guest()
                        <li><a class="header__list-item header__list-item--small" href="/login">Inloggen</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</header>
