<header class="header">
    <div class="container">
        <div class="header__content">
            <ul class="header__list">
                @auth()
                    <li><a class="header__list-item header__list-item--show" href="/"><img draggable="false" class="header__logo" src="{{asset('images/stage-tracker.png')}}" alt=""></a></li>
                    <li><a class="header__list-item" href="">Uren indienen</a></li>
                    <li><a class="header__list-item" href="">Overzicht</a></li>
                @endauth
            </ul>
            <ul class="header__list header__list--right">
                @auth()
                    <li><a class="header__list-item" href="/profiel">Profiel</a></li>
                    <li><a class="header__list-item" href="/logout">Uitloggen</a></li>
                @endauth
                @guest()
                    <li><a class="header__list-item" href="/login">Inloggen</a></li>
                @endguest
                    <div class="header__hamburger-wrap">
                        <div class="header__hamburger">
                        </div>
                    </div>
            </ul>
            <div class="header__hamburger-menu">
                <ul class="header__list header__list--small">
                    @auth()
                        <li><a class="header__list-item header__list-item--small" href="">Uren indienen</a></li>
                        <li><a class="header__list-item header__list-item--small" href="">Overzicht</a></li>
                    @endauth
                </ul>
                <ul class="header__list header__list--small">
                    @auth()
                        <li><a class="header__list-item header__list-item--small" href="/profiel">Profiel</a></li>
                        <li><a class="header__list-item header__list-item--small" href="/logout">Uitloggen</a></li>
                    @endauth
                    @guest()
                        <li><a class="header__list-item header__list-item--small" href="/login">Inloggen</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</header>
