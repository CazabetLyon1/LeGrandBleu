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
                    <div id="carouselPaysDom" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            <?php foreach ($pays as $objPays) { ?>
                                <div class="item">
                                    <p id="<?php echo $objPays->pays."_Dom";?>"><?php echo $objPays->pays;?></p>
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
                    <div id="myCarousel2" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
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
                <div class="row">
                    <div class="col-md-12"><h4><i class="fa fa-user-circle"></i> Équipe Extérieure</h4></div>
                </div>
                <div class="row text-center">
                    <div id="carouselPaysDo" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">

                            <?php foreach ($pays as $objPays) { ?>
                            <div class="item">
                                <p id="<?php echo $objPays->pays;?>Ext"><?php echo $objPays->pays;?></p>
                            </div>
                            <?php } ?>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselPaysDo" data-slide="prev">
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
                    <div id="carouselChoixTeamExt" class="carousel" data-ride="carousel" data-interval="0">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item">fs</div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#carouselChoixTeamExt" data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                            <span class="sr-only">Précédent</span>
                        </a>
                        <a class="right carousel-control" href="#carouselChoixTeamExt" data-slide="next">
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


@endsection