<?php
/**
 * Created by PhpStorm.
 * User: jaysonkaced
 * Date: 06/02/2018
 * Time: 16:42
 */
?>

@extends('layouts.app')

@section('title') Stats&CO - Résultat de la simulation @endsection

@section('css')
    {!! Html::style('css/SimulationResultat.css') !!}
@endsection

@section('container')
    <div class="section container-fluid container-perso">
        <div class="row block">
            <div class="col-md-3 col-xs-6 text-right">
                <h1 class="nom-club-result text-center"><?php echo $clubDomicile->nom_club;?></h1>
                {{ HTML::image($clubDomicile->url_club, 'Logo '.$clubDomicile->nom_club, array('class' => 'logo-club-title')) }}
            </div>
            <div class="statTeam col-md-3 col-xs-6 text-center">
                <h3><span class="label label-default">ATT : <?php echo $forceAttDomicile;?></span></h3>
                <h3><span class="label label-default">DEF : <?php echo $potentielDefDomicile;?></span></h3>
            </div>

            <div class="statTeam col-md-3 col-xs-6 text-center">
                <h3><span class="label label-default">ATT : <?php echo $forceAttExterieur;?></span></h3>
                <h3><span class="label label-default">DEF : <?php echo $potentielDefExterieur;?></span></h3>
            </div>
            <div class="col-md-3 col-xs-6 text-left">
                <h1 class="nom-club-result text-center"><?php echo $clubExterieur->nom_club;?></h1>
                {{ HTML::image($clubExterieur->url_club, 'Logo '.$clubExterieur->nom_club, array('class' => 'logo-club-title')) }}
            </div>

        </div>
        <div class="row block">
            <div class="col-md-3 col-xs-12 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="far fa-clock fa-pulse fa-lg"></i> Anciennes Rencontres</h2>
                    </div>
                </div>
                <?php if(!empty($rencontres)) {
                    foreach ($rencontres as $objMatch) { ?>
                    <div class="row dateMatch">
                        <div class="col-md-3 col-xs-3">
                            <?php echo $objMatch->date;?>
                        </div>
                        <div class="col-md-3 col-xs-3 text-right">
                            {{ HTML::image($clubDomicile->url_club, 'Logo '.$clubDomicile->nom_club, array('class' => 'logo-club-32')) }}
                        </div>
                        <div class="col-md-3 col-xs-3">
                            <?php echo $objMatch->but_domicile.' - '.$objMatch->but_exterieur;?>
                        </div>
                        <div class="col-md-3 col-xs-3 text-left">
                            {{ HTML::image($clubExterieur->url_club, 'Logo '.$clubExterieur->nom_club, array('class' => 'logo-club-32')) }}
                        </div>
                    </div>
                    <?php }
                } else { ?>
                    <div class="row dateMatch">
                        <div class="col-md-12 col-xs-12 text-center">
                            <p class="noUpper">Aucune données disponibles</p>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 hidden-xs hidden-sm">
                        <h2><i class="fas fa-futbol fa-lg"></i> Probabilités de marquer 0 à 5 buts</h2>
                    </div>
                    <div class="col-md-12 text-center hidden-md hidden-lg">
                        <h2><i class="fas fa-futbol fa-lg"></i> Probabilités de marquer</h2>
                    </div>
                    <div class="col-md-12 chartLoiDePoisson">
                        {!! $chart1->container() !!}
                    </div>
                    <div class="col-md-12 00ffff">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fas fa-calculator fa-lg"></i> Méthodes utilisées</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="nameAl">Loi de Poisson</p>
                        <p class="noUpper justify">La loi de Poisson est un concept mathématique qui
                            transpose des moyennes en une probabilité de résultats variables.</p>
                    </div>
                    <div class="col-md-12">
                        <p class="nameAl">Conversion en cotes</p>
                        <p class="noUpper justify">La conversion en cotes permet de comparer les résultats de l'algorithme
                            avec celles des professionnelles durant les rencontres sportives.</p>
                    </div>
                    <div class="col-md-12"><p class="nameAl">Autres Lois</p></div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Of Main Application -->
@endsection

@section('scripts')

    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>

    {!! $chart1->script() !!}
    {!! Html::script('js/simulationResultat.js') !!}

@endsection