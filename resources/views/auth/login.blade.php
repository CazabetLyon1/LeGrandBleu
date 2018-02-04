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

        <div id="svg_background">
            <object>
                <embed src="{{ asset('storage/2Weeks_Images/Auth/bckgrd_cours.svg') }}" border="5"></embed>
            </object>
        </div>

        {{-- login part--}}
        <div id="login_cards_container" class="active">
            <div class="connect_cards_background">
                <object>
                    <embed src="{{ asset('storage/2Weeks_Images/Auth/bckgrd_cours.svg') }}"></embed>
                </object>
            </div>
            <div class="connect_cards_darkbackground"></div>

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

                    <button type="submite">Connect</button>
                    <a class="forgot_passwd_link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                </form>
            </div>
        </div>

        {{--register part--}}
        <div id="register_cards_container" class="">
            <div class="connect_cards_background">
                <object>
                    <embed src="{{ asset('storage/2Weeks_Images/Auth/bckgrd_cours.svg') }}"></embed>
                </object>
            </div>
            <div class="connect_cards_darkbackground"></div>

            <div class="connect_cards_header">
                <div id="register_icon"></div>
            </div>

            <div class="connect_cards_body">

                <form class="connect_cards_form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="connect_cards_form_containers{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label  for="register_cards_input_name"></label>
                        <input type="text" name="name" id="register_cards_input_name" placeholder="Cristiano" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="error-block">
                                <strong>{{ $errors->first('name') }}</strong>
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

                    <button type="submite">Register</button>
                </form>
            </div>

        </div>

    </div>

    <div class="section"></div>


@endsection