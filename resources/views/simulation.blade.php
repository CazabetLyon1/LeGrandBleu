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
    {!! Html::style('css/simulation.css') !!}
@endsection

@section('container')
    <div class="section container-fluid container-perso">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="hidden-xs   hidden-sm    ">Simulation de rencontre sportive</h1>
                <p class="noUpper">Choississez les deux équipes qui s'affronteront et cliquez pour commencer la simulation !</p>
            </div>
            <div class="col-md-12 text-center" id="boutonValiderSimulation">
                <a class="btn btn-success" id="validerSimulation" role="button">Commencer la simulation</a>
            </div>
        </div>
        <div class="row block">

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 text-center"><h4><i class="fa fa-home"></i> equipe domicile</h4></div>
                </div>
                <div class="row text-center">
                    <div id="carouselPaysDom" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            <?php foreach ($pays as $objPays) { ?>
                                <div class="item">
                                    <p id="<?php echo $objPays->pays;?>"><?php echo $objPays->pays;?></p>
                                </div>
                            <?php } ?>

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselPaysDom" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#carouselPaysDom" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
                <br />
                <div class="row text-center">
                    <div id="carouselClubDom" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselClubDom" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#carouselClubDom" data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                            <span class="sr-only">Suivant</span>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="visible-xs small">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 text-center"><h4><i class="fa fa-bus"></i> equipe exterieure</h4></div>
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
    </div>
@endsection

@section('scripts')

    <script>
        var token = '{{ Session::token() }}';
        var url = '{{route('getClub')}}';
    </script>
    <!-- Scripts -->
    {!! Html::script('js/simulation.js') !!}

@endsection