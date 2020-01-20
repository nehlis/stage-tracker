@extends('layouts.app')

@section('content')
    <div class="login content">
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
                        <label class="login__label" for="remember">{{ __('Onthoud mij') }}</label>

                        <button type="submit" class="button button--primary login__button">
                            {{ __('Inloggen') }}
                        </button>
                        <hr>
                        @if (Route::has('password.request'))
                            <a class="button button--small login__button-small" href="{{ route('password.request') }}">
                                {{ __('Wachtwoord vergeten?') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            {{--    <div class="row justify-content-center">--}}
            {{--        <div class="col-md-8">--}}
            {{--            <div class="card">--}}
            {{--                <div class="card-header">{{ __('Login') }}</div>--}}

            {{--                <div class="card-body">--}}
            {{--                    <form method="POST" action="{{ route('login') }}">--}}
            {{--                        @csrf--}}

            {{--                        <div class="form-group row">--}}
            {{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

            {{--                            <div class="col-md-6">--}}
            {{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

            {{--                                            @error('email')--}}
            {{--                                                <span class="invalid-feedback" role="alert">--}}
            {{--                                                    <strong>{{ $message }}</strong>--}}
            {{--                                                </span>--}}
            {{--                                            @enderror--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                        <div class="form-group row">--}}
            {{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

            {{--                            <div class="col-md-6">--}}
            {{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

            {{--                                            @error('password')--}}
            {{--                                                <span class="invalid-feedback" role="alert">--}}
            {{--                                                    <strong>{{ $message }}</strong>--}}
            {{--                                                </span>--}}
            {{--                                            @enderror--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                        <div class="form-group row">--}}
            {{--                            <div class="col-md-6 offset-md-4">--}}
            {{--                                <div class="form-check">--}}
            {{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

            {{--                                    <label class="form-check-label" for="remember">--}}
            {{--                                        {{ __('Remember Me') }}--}}
            {{--                                    </label>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}

            {{--                        <div class="form-group row mb-0">--}}
            {{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                            <button type="submit" class="btn btn-primary">--}}
{{--                                                {{ __('Login') }}--}}
{{--                                            </button>--}}

{{--                                            @if (Route::has('password.request'))--}}
{{--                                                <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                                    {{ __('Forgot Your Password?') }}--}}
{{--                                                </a>--}}
{{--                                            @endif--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </form>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--        </div>--}}
            {{--    </div>--}}
        </div>
    </div>
@endsection
