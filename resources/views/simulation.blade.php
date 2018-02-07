<?php
/**
 * Created by PhpStorm.
 * User: jaysonkaced
 * Date: 06/02/2018
 * Time: 16:42
 */
?>

@extends('layouts.app')

@section('css')
    {!! Html::style('css/Simulation.css') !!}
@endsection

@section('container')
    <div class="container container-perso">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Simulation de rencontre sportive</h1>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12"><h4><i class="fa fa-user-circle"></i> Équipe Domicile</h4></div>
                </div>
                <div class="row text-center">
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL fsdq sqfsq sfsq</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <a href="{{ url('/simulation') }}">
                            <img class="logo-club" src="{!! url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') !!}">
                        </a>
                        <p>OL</p>
                    </div>


                </div>
            </div>

            <div class="col-md-6">
                <h4><i class="fa fa-user-circle"></i> Équipe Exterieur</h4>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="navbar-fixed-bottom">rregerereger<br />rregerereger<br /></footer>
@endsection
