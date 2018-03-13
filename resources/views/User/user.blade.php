@extends('layouts.app')
@section('title') {!!  $user->first_name.' '.$user->last_name !!} @endsection
@section('css')
    @if(Auth::id() == $user->id)
        {!! Html::style('css/popUpJs/popUpStyle.css') !!}
    @endif
    {!! Html::style('css/userPage.css') !!}
@endsection
@section('scripts')
    @if(Auth::id() == $user->id)
        <script>
            var token = '{{ Session::token() }}';
            var url = '{{route('accounts_images')}}';
            var url1 = '{{route('change_accounts_images')}}';
            var url2 = '{{route('search_accounts_team')}}';
            var url3 = '{{route('change_accounts_team')}}';
            var url5 = '{{asset('')}}';
        </script>
        {!! Html::script('js/popUpJs/searchPopUp_plugin.js') !!}
        {!! Html::script('js/userPage.js') !!}
    @endif

@endsection

@section('container')
    <div class="section sct-pd container-fluid">
            <div class="row block">
                <div class="col-md-12">

                    <div id="account-status">
                        <div class="account-info">
                            <div class="header popUpSearch_activator @if(Auth::id() == $user->id){{'user-can-modif'}}@endif" data-toggle="modal" data-target="#myModal" style="background: #070025  url('{{ asset($user->avatar_url) }}')no-repeat 50% 50% / cover;"></div>
                            <div class="body">
                                <p class="user_name xl-OrkneyBold">{!! $user->first_name.' '.$user->last_name !!}</p>
                                <p class="user_email">{!! $user->email !!}</p>
                            </div>
                        </div>
                        <div class="account-nav">
                            <div class="item item-info active">
                                <div></div>
                                <p class="sm-OrkneyBold">infos</p>
                            </div>
                            <div class="item item-stats">
                                <div></div>
                                <p class="sm-OrkneyBold">stats</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6 col-xs-12 neon-right">

                    <div class="block-section block">
                        <div class="block-title">
                            <div class="block-title-icon favorite-icon"></div>
                            <p class="block-title-text">Equipe favorite</p>
                        </div>
                        <div class="block-content">
                            <div class="content-plcmt" id="favorite-team-content">
                                <div class="logo-favorite-team-popUp logo-favorite-team bg-icon @if(Auth::id() == $user->id){{'user-can-modif'}}@endif" style="background: transparent url('{{ asset($user->url_club) }}') no-repeat 50% 50% / contain;"></div>
                                <p class="name-favorite-team md-OrkneyBold">{{ $user->nom_club }}</p>
                                <p class="att-def-favorite-team md-OrkneyLight">Att : <span class="md-OrkneyBold">90</span> Def : <span class="md-OrkneyBold"> 85</span></p>
                                <p class="country-favorite-team sm-OrkneyLight">{{ $user->pays }} - {{ $user->nom_ville }}</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
@endsection