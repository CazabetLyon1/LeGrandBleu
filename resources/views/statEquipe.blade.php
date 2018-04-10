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

            <div class="col-md-6" text-left>
                <div class="container">
                    <div class="col-md-2">
                    <input id="rad1" type="radio" name="rad" checked>
                    <section style="background: none"> <div class="iconcustom"> <i style= "color:green"  class="fa fa-futbol" style="color:green" ></i></div>
                        <h1 class="nom-club-result"><?php echo $nbButTot;?></h1>
                        <h1 class="nom-club-result">Buts marqués</h1>
                        <p class ="noUpper"> (<?php echo $nbButExterieur?> exterieur <?php echo $nbButDomicile?> domicile)</p>

                    </section>
                    </div>
                    <div class="col-md-2">
                    <input id="rad2" type="radio" name="rad">
                    <section style="background: none"> <div class="iconcustom"><i class="fa fa-futbol" style = "color:red"></i></div>
                        <h1 class="nom-club-result"><?php echo $nbPrisTot;?></h1>
                        <h1 class="nom-club-result">Buts encaissés</h1>
                        <p class ="noUpper"> (<?php echo $nbPrisExterieur?> exterieur <?php echo $nbPrisDomicile?> domicile)</p>

                    </section>
                    </div>
                    <div class="col-md-2">
                    <input id="rad3" type="radio" name="rad">
                    <section style="background: none"><div class="iconcustom"> <i class="fa fa-trophy" style ="color:green"></i></div>
                        <h1 class="nom-club-result"><?php echo $nbVictoire;?></h1>
                        <h1 class="nom-club-result">Victoires</h1>
                        <p class ="noUpper"> (<?php echo $nbMatchWinExterieur?> exterieur <?php echo $nbMatchWinDom?> domicile)</p>

                    </section>
                    </div>
                    <div class="col-md-2">
                    <input id="rad4" type="radio" name="rad">
                    <section style="background: none"> <div class="iconcustom"><i class="fa fa-trophy" style="color:red"></i></div>
                        <h1 class="nom-club-result"><?php echo $nbDefaite;?></h1>
                        <h1 class="nom-club-result">Defaites</h1>
                        <p class ="noUpper"> (<?php echo $nbMatchDefExterieur?> exterieur <?php echo $nbMatchDefDom?> domicile)</p>

                    </section>
                    </div>
                    <div class="col-md-2">
                    <input id="rad5" type="radio" name="rad">
                    <section style="background: none"> <div class="iconcustom"><i class="fa fa-trophy" style="color:yellow"></i></div>
                        <h1 class="nom-club-result"><?php echo $nbNul;?></h1>
                        <h1 class="nom-club-result">Matchs nuls</h1>
                        <p class ="noUpper"> (<?php echo $nbMatchNulExterieur?> exterieur <?php echo $nbMatchNulDom?> domicile)</p>

                    </section>
                    </div>
                </div>
            </div>

        </div>


            <div class ="row">
            <div class = "col-md-6 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="far fa-clock fa-pulse fa-lg"></i> Dernieres Rencontres</h2>
                    </div>
                </div>

                <?php if(!empty($rencontres)) {
                foreach ($rencontres as $objMatch) { ?>
                <div class="row dateMatch">
                    <div class="col-md-3 text-right nomclubperso">
                        <?php echo $clubChoisis->nom_club;?>
                    </div>
                    <div class="col-md-6 text-center">
                        <ul class="list-inline nomclubperso">
                            <li>{{ HTML::image($clubChoisis->url_club, 'Logo '.$clubChoisis->nom_club, array('class' => 'logo-club-32')) }}</li>
                            <li><?php echo $objMatch->but_domicile.' - '.$objMatch->but_exterieur;?></li>
                            <?php foreach($clubAdverse as $objClub) {
                                if($objClub->id_club == $objMatch->equipe_exterieur || $objClub->id_club == $objMatch->equipe_domicile) { ?>
                                    <li> {{ HTML::image($objClub->url_club, 'Logo '.$objClub->nom_club, array('class' => 'logo-club-32')) }}</li>

                        </ul>
                    </div>
                    <div class="col-md-3 text-left nomclubperso">
                        <?php echo $objClub->nom_club;?> <?php }
                        }?>
                    </div>
                </div>
                <div class="row dateMatch1">
                    <div class="col-md-12 text-center">
                        <?php echo  $objMatch->date;?>
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
                <div class = "col-md-6 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <h2><i class="far fa-futbol"></i> Dernieres Saisons</h2>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($choixAnnee as $annee) { ?>
                        <div class="item">
                            <p id="<?php echo $annee;?>"><?php echo $annee;?></p>
                        </div>
    <?php } ?>
        </div>
    </div>



    <!-- End Of Main Application -->
@endsection

@section('scripts')

    {!! Html::script('js/selectTeam.js') !!}

@endsection