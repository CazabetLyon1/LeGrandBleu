@extends('layouts.app')
@section('title') User @endsection
@section('css')
    {!! Html::style('css/userPage.css') !!}
@endsection
@section('scripts')
@endsection

@section('container')
    <div class="section sct-pd container-fluid">
            <div class="row block">
                <div class="col-md-12">

                    <div id="account-status">
                        <div class="account-info">
                            <div class="header" data-toggle="modal" data-target="#myModal"></div>
                            <div class="body">
                                <p class="user_name xl-OrkneyBold">Thibaud Perrin</p>
                                <p class="user_email">thibaud.perrin@gmail.com</p>
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
                            <div class="content-plcmt">
                                <div class="logo-favorite-team bg-icon"></div>
                                <p class="name-favorite-team md-OrkneyBold">Olympique Lyonnais</p>
                                <p class="att-def-favorite-team md-OrkneyLight">Att : <span class="md-OrkneyBold">90</span> Def : <span class="md-OrkneyBold"> 85</span></p>
                                <p class="country-favorite-team sm-OrkneyLight">France - Lyon</p>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>


    </div>
@endsection