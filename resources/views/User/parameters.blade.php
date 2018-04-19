@extends('layouts.app')

@section('title') {!!  $user->first_name.' '.$user->last_name !!}-parametres @endsection

@section('css')
    {!! Html::style('css/userPage.css') !!}
    {!! Html::style('css/userParameters.css') !!}
@endsection

@section('scripts')
@endsection

@section('container')
    <div class="section sct-pd ">
        <div class="container">
            <div class="row block">
                <div class="col-lg-6 mrg-auto ">

                    <div class="block-section block">
                        <div class="block-title">
                            <div class="block-title-icon user-icon"></div>
                            <p class="block-title-text">Infos Utilisateur</p>
                        </div>
                        <div class="block-content">

                            <form class="param_form" method="POST" action="{{ route('user-parameters-update', $user->login) }}">
                                {{ csrf_field() }}
                                @if(session()->has('update'))
                                    <div class="alert alert-success">
                                        {{ session()->get('update') }}
                                    </div>
                                @endif
                                <div class="param_form_containers param_form_containers_name{{ $errors->has('first_name') ? ' has-error' : '' }} ">
                                    <label  for="param_input_first_name"></label>
                                    <input type="text" name="first_name" id="param_input_first_name" value="{{$user->first_name}}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="param_form_containers param_form_containers_name{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label  for="param_input_last_name"></label>
                                    <input type="text" name="last_name" id="param_input_last_name" value="{{ $user->last_name }}" required>
                                    @if ($errors->has('last_name'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="param_form_containers{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label  for="param_input_email"></label>
                                    <input type="email" name="email" id="param_input_email" value="{{$user->email}}" disabled>
                                    @if ($errors->has('email'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="param_form_containers{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                    <label  for="param_input_birthday"></label>
                                    <input type="date" name="birthday" id="param_input_birthday" value="{{ $user->birthday }}" required>
                                    @if ($errors->has('birthday'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('birthday') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button class="boutton_option sm-OrkneyLight" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    Mot de passe
                                </button>
                                <div class="collapse" id="collapseExample">
                                <div class="param_form_containers{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                    <label  for="param_input_old_password"></label>
                                    <input type="password" name="old_password" id="param_input_old_password" value="" placeholder="Ancien mot de passe">
                                    @if ($errors->has('old_password'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="param_form_containers{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label  for="param_input_password"></label>
                                    <input type="password" name="password" id="param_input_password" placeholder="nouveau mot de passe">
                                    @if ($errors->has('password'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    @if(session()->has('success'))
                                        <div class="success-block">
                                            {{ session()->get('success') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="param_form_containers{{ $errors->has('password') ? ' has-error' : '' }}"">
                                    <label  for="param_input_passwordVerify"></label>
                                    <input type="password" name="password_confirmation" id="param_input_passwordVerify" placeholder="confirmation mot de passe">
                                    @if ($errors->has('password'))
                                        <span class="error-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                                <button type="submit">Register</button>
                            </form>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection