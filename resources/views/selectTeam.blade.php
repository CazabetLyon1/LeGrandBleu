<?php
/**
 * Created by PhpStorm.
 * User: arnauddailler
 * Date: 06/02/2018
 * Time: 16:42
 */
?>

@extends('layouts.app')

@section('title') Stats&CO - Simulation de rencontre sportive @endsection

@section('css')
    {!! Html::style('css/selectTeam.css') !!}
@endsection

@section('container')
    <div class="section container-fluid container-perso">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="visible-md">Simulation de rencontre sportive</h1>
                <p class="noUpper">Selectionnez l'equipe dont vous désirez consulter les informations</p>
            </div>
        </div>
        <div class="row block">
            <hr class="visible-xs small">
            <div class="col-md-offset-3 col-md-6">
                <div class="row text-center">
                    <div class="col-md-12 text-center"><h4></i>Equipe sélectionnée</h4></div>
                </div>
                <div class="row text-center">
                    <div id="carouselPaysExt" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            <?php foreach ($pays as $objPays) { ?>
                            <div class="item">
                                <p id="<?php echo $objPays->pays;?>"><?php echo $objPays->pays;?></p>
                            </div>
                            <?php } ?>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselPaysExt" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#carouselPaysExt" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
                <br />
                <div class="row text-center">
                    <div id="carouselClubExt" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselClubExt" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#carouselClubExt" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12 text-center" id="boutonValiderSimulation">
            <a  class="btn btn-success"  id="validerSimulation" role="button">Rechercher cette équipe</a>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        var token = '{{ Session::token() }}';
        var url = '{{route('getClub')}}';
    </script>
    <!-- Scripts -->
    {!! Html::script('js/selectTeam.js') !!}

@endsection