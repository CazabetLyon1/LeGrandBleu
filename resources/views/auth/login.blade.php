@extends('layouts.app')
@section('title') Connection @endsection
@section('css')
    {!! Html::style('css/FullpageJs/jquery.fullpage.min.css') !!}
    {!! Html::style('css/connection.css') !!}
@endsection
@section('scripts')
    {!! Html::script('js/FullpageJs/jquery.fullpage.min.js') !!}
    {!! Html::script('js/connection.js') !!}
@endsection

@section('container')


    <div class="section" id="connection-section">

        <div id="background"></div>


        {{-- login part--}}
        <div id="auth_cards_container">
            <ul class="hearder">
                <li id="onglet-auth-connection" class="md-OrkneyLight onglet-auth active">Connection</li>
                <li id="onglet-auth-inscription" class="md-OrkneyLight onglet-auth">Inscription</li>
            </ul>

            <div class="body">
                <div id="login_cards_container" class="active">
                    <form class="connect_cards_form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="connect_cards_form_containers {{ $errors->has('email') ? ' has-error' : '' }} ">
                            <label for="login_cards_input_login" ></label>
                            <input type="text" name="email" id="login_cards_input_login" placeholder="CR7@real.com" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="error-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="connect_cards_form_containers {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="login_cards_input_password"></label>
                            <input type="password" name="password" id="login_cards_input_password" required>
                            @if ($errors->has('password'))
                                <span class="error-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>

                        <button type="submit">Connect</button>
                        <a class="forgot_passwd_link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </form>
                </div>


            <div id="register_cards_container" class="">

                    <form class="connect_cards_form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="connect_cards_form_containers connect_cards_form_containers_name{{ $errors->has('first_name') ? ' has-error' : '' }} ">
                            <label  for="register_cards_input_first_name"></label>
                            <input type="text" name="first_name" id="register_cards_input_first_name" placeholder="Cristiano" value="{{ old('first_name') }}" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="error-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif

                        </div>
                        <div class="connect_cards_form_containers connect_cards_form_containers_name{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label  for="register_cards_input_last_name"></label>
                            <input type="text" name="last_name" id="register_cards_input_last_name" placeholder="Ronaldo" value="{{ old('last_name') }}" required autofocus>
                            @if ($errors->has('last_name'))
                                <span class="error-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="connect_cards_form_containers{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label  for="register_cards_input_email"></label>
                            <input type="email" name="email" id="register_cards_input_email" placeholder="CR7@real.com"  value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="error-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="connect_cards_form_containers{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label  for="register_cards_input_birthday"></label>
                            <input type="date" name="birthday" id="register_cards_input_birthday" value="{{ old('birthday') }}" required>
                            @if ($errors->has('birthday'))
                                <span class="error-block">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="connect_cards_form_containers{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label  for="register_cards_input_password"></label>
                            <input type="password" name="password" id="register_cards_input_password" required>
                            @if ($errors->has('password'))
                                <span class="error-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="connect_cards_form_containers">
                            <label  for="register_cards_input_passwordVerify"></label>
                            <input type="password" name="password_confirmation" id="register_cards_input_passwordVerify">
                        </div>

                        <button type="submit">Register</button>
                    </form>

            </div>
            </div>

        </div>
        {{--<div id="login_cards_container" class="active">
            <div class="connect_cards_header">
                <div id="login_icon"></div>
            </div>

            <div class="connect_cards_body">

                <form class="connect_cards_form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="connect_cards_form_containers {{ $errors->has('email') ? ' has-error' : '' }} ">
                        <label for="login_cards_input_login" ></label>
                        <input type="text" name="email" id="login_cards_input_login" placeholder="CR7@real.com" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="error-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="connect_cards_form_containers {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="login_cards_input_password"></label>
                        <input type="password" name="password" id="login_cards_input_password" required>
                        @if ($errors->has('password'))
                            <span class="error-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <button type="submit">Connect</button>
                    <a class="forgot_passwd_link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </form>
            </div>
        </div>--}}

        {{--register part--}}
        {{--<div id="register_cards_container" class="">

            <div class="connect_cards_header">
                <div id="register_icon"></div>
            </div>

            <div class="connect_cards_body">

                <form class="connect_cards_form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="connect_cards_form_containers connect_cards_form_containers_name{{ $errors->has('first_name') ? ' has-error' : '' }} {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label  for="register_cards_input_first_name"></label>
                        <input type="text" name="first_name" id="register_cards_input_first_name" placeholder="Cristiano" value="{{ old('first_name') }}" required autofocus>
                        @if ($errors->has('first_name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif

                        <label  for="register_cards_input_last_name"></label>
                        <input type="text" name="last_name" id="register_cards_input_last_name" placeholder="Ronaldo" value="{{ old('last_name') }}" required autofocus>
                        @if ($errors->has('last_name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="connect_cards_form_containers{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label  for="register_cards_input_email"></label>
                        <input type="email" name="email" id="register_cards_input_email" placeholder="CR7@real.com"  value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="error-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="connect_cards_form_containers{{ $errors->has('birthday') ? ' has-error' : '' }}">
                        <label  for="register_cards_input_birthday"></label>
                        <input type="date" name="birthday" id="register_cards_input_birthday" value="{{ old('birthday') }}" required>
                        @if ($errors->has('birthday'))
                            <span class="error-block">
                                <strong>{{ $errors->first('birthday') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="connect_cards_form_containers{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label  for="register_cards_input_password"></label>
                        <input type="password" name="password" id="register_cards_input_password" required>
                        @if ($errors->has('password'))
                            <span class="error-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>


                    <div class="connect_cards_form_containers">
                        <label  for="register_cards_input_passwordVerify"></label>
                        <input type="password" name="password_confirmation" id="register_cards_input_passwordVerify">
                    </div>

                    <button type="submit">Register</button>
                </form>
            </div>

        </div>--}}

    </div>

    <div class="section"></div>


@endsection