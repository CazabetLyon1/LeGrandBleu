<?php
/**
 * Created by PhpStorm.
 * User: jaysonkaced
 * Date: 06/02/2018
 * Time: 16:42
 */
?>

@extends('layouts.app')

@section('title') Stats&CO - Simulation de rencontre sportive @endsection

@section('css')
    {!! Html::style('css/Simulation.css') !!}
@endsection

@section('container')
    <div class="section container-fluid container-perso">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Simulation de rencontre sportive</h1>
            </div>
        </div>
        <div class="row block">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12"><h4><i class="fa fa-user-circle"></i> Équipe Domicile</h4></div>
                </div>
                <div class="row text-center">
                    <div id="myCarousel" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" onchange='choixPays(this.p)'>
                            <?php foreach ($pays as $objPays) { ?>
                            <div class="item" >
                                <p><?php echo $objPays->pays;?></p>
                            </div>
                            <?php } ?>

                            <div class="item active">
                                <p>Selectionnez un pays</p>
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
                <br />
                <div class="row text-center">
                    <div id="myCarousel2" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="logo-club center-block" style="background: transparent url({{ url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') }}) no-repeat 50% 50% / contain"></div>
                                <p>Olympique Lyonnais</p>
                            </div>

                            <?php foreach ($clubs as $club) { ?>
                            <div class="item">
                                <div class="logo-club center-block" style="background: transparent url({{ url('2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png') }}) no-repeat 50% 50% / contain"></div>
                                <p><?php echo $club->nom_club;?></p>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control blabla" href="#myCarousel2" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h4><i class="fa fa-user-circle"></i> Équipe Exterieur</h4>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/simulation.js') }}"></script>
@endsection