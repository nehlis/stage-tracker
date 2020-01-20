@extends('layouts.app')

@section('content')
    <div class="content login">
        <div class="container login__container">
            <div class="row">
                <div class="col-md-6">
                    <img class="login__image" draggable="false" src="{{asset('images/undraw_Login.svg')}}" alt="Login drawing">
                </div>
                <div class="col-md-6">
                    <h1 class="login__heading">Inloggen</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <label for="email" class="login__label">{{ __('Uw emailadres') }}</label>
                        <input id="email" type="email" class="login__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <label for="password" class="login__label">{{ __('Uw wachtwoord') }}</label>
                        <input id="password" type="password" class="login__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <input class="login__checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="login__label login__label-no-p" for="remember">{{ __('Onthoud mij') }}</label>

                        @if (Route::has('password.request'))
                            <a class="button button--small login__button-small login__button--right" href="{{ route('password.request') }}">
                                {{ __('Wachtwoord vergeten?') }}
                            </a>
                        @endif
                        <hr>
                        <button type="submit" class="button button--primary login__button">
                            {{ __('Inloggen') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
