@extends('layouts.app')

@section('title', 'Uw profiel | Stage Tracker')

@section('content')
    <div class="container content login__container">
        <div class="row">
            <div class="col-md-6">
                <img class="login__image login__image--small" src="{{asset('images/undraw_account.svg')}}" alt="">
            </div>
            <div class="col-md-6">
                <h1 class="login__heading">Profiel</h1>
                <form method="post" action="{{route('profiel.update', $user)}}">
                    @csrf
                    @method('patch')


                    <label for="name" class="login__label">{{ __('Naam') }}</label>


                    <input id="name" type="text" value="{{ $user->name }}"
                           class="login__input @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{  ucfirst($message) }}</strong>
                        </span>
                    @enderror


                    <label for="email" class="login__label">{{ __('Email') }}</label>

                    <input id="email" type="email" value="{{ $user->email }}"
                           class="login__input @error('email') is-invalid @enderror" name="email"
                           value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{  ucfirst($message) }}</strong>
                            </span>
                    @enderror


                    <label for="password"
                           class="login__label">{{ __('Wachtwoord') }}</label>


                    <input id="password" type="password"
                           class="login__input @error('password') is-invalid @enderror" name="password"
                           autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{  ucfirst($message) }}</strong>
                            </span>
                    @enderror


                    <label for="password-confirm"
                           class="login__label">{{ __('Bevestig Wachtwoord') }}</label>


                    <input id="password-confirm" type="password" class="login__input"
                           name="password_confirmation"
                           autocomplete="new-password">

                    <button type="submit" class="btn btn-primary">
                        Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
