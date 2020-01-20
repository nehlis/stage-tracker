<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 footer__col">
                <h3 class="footer__heading">Menu</h3>
                <ul class="footer__list">
                    <li class="footer__list-item footer__text"><a href="{{route('home')}}">Uren indienen</a></li>
                    <li class="footer__list-item footer__text"><a href="{{route('overzicht')}}">Overzicht</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer__col">
                <h3 class="footer__heading">Account</h3>
                <ul class="footer__list">
                    <li class="footer__list-item footer__text"><a href="{{route('profiel')}}">Profiel</a></li>
                    <li class="footer__list-item footer__text"><a href="#">Uitloggen</a></li>
                    @guest
                        <li class="footer__list-item footer__text"><a href="/register">Registreren</a></li>
                        <li class="footer__list-item footer__text"><a href="/password-reset">Wachtwoord vergeten</a></li>
                    @endguest
                </ul>
            </div>
        </div>
        <hr>
        <p class="footer__text footer__copyright">Copyright {{date('Y')}} &copy; Stage Tracker</p>
    </div>
</footer>
