<?php
/**
 * Created by PhpStorm.
 * User: ardailler
 * Date: 06/02/2018
 * Time: 16:42
 */
?>

@extends('layouts.app')

@section('title') Stats&CO - Résultat de la simulation @endsection

@section('css')
    {!! Html::style('css/StatEquipe.css') !!}
@endsection

@section('container')
    <div class="section container-fluid container-perso">
        <div class="row block">
             <div class="col-md-3 col-xs-6 text-right">
                <h1 class="nom-club-result text-center"><?php echo $clubChoisis->nom_club;?></h1>
                {{ HTML::image($clubChoisis->url_club, 'Logo '.$clubChoisis->nom_club, array('class' => 'logo-club-title')) }}
            </div>
            <div class="col-md-3">
                <p class="nameAl">Informations</p>
                <p class=" noUpper justify">NOM DU CLUB : <?php echo $clubChoisis->nom_club;?>.</p>
                <p class=" noUpper justify ">ENTRAINEUR : <?php echo $clubChoisis->entraineur;?></p>
                <p class="noUpper justify">PRESIDENT : <?php echo $clubChoisis->president;?> .</p>
                <p class="noUpper justify"> FONDATION : <?php echo $clubChoisis->fondation;?></p>
                <p class="noUpper justify"> STADE : <?php echo $clubChoisis->stade;?></p>
            </div>
        </div>
            <div class ="row">
            <div class = "col-md-6 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="far fa-clock fa-pulse fa-lg"></i> Anciennes Rencontres</h2>
                    </div>
                </div>

                <?php if(!empty($rencontres)) {
                foreach ($rencontres as $objMatch) { ?>
                <div class="row dateMatch">
                    <div class="col-md-3 text-left">
                        <?php echo $objMatch->date;?>
                    </div>
                    <div class="col-md-5 text-center">
                        <ul class="list-inline">
                            <li>{{ HTML::image($clubChoisis->url_club, 'Logo '.$clubChoisis->nom_club, array('class' => 'logo-club-32')) }}</li>
                            <li><?php echo $objMatch->but_domicile.' - '.$objMatch->but_exterieur;?></li>
                            <?php foreach($clubAdverse as $objClub) {
                                if($objClub->id_club == $objMatch->equipe_exterieur) { ?>
                                    <li> {{ HTML::image($objClub->url_club, 'Logo '.$objClub->nom_club, array('class' => 'logo-club-32')) }}</li>
                                <?php }
                            }?>
                        </ul>
                    </div>
                </div>
                <?php }
                } else { ?>
                <div class="row dateMatch">
                    <div class="col-md-12 col-xs-2 text-center">
                        <p class="noUpper">Aucune données disponibles</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>



    <!-- End Of Main Application -->
@endsection

@section('scripts')

    {!! Html::script('js/selectTeam.js') !!}

@endsection