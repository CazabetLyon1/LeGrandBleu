<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Charts\SampleChart;
use Poisson;

class SelectTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pays = DB::select('SELECT DISTINCT pays FROM clubs');
        return view('selectTeam', ['pays' => $pays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getClubByPays(Request $request)
    {
        $clubs = DB::table('clubs')
            ->where([
                ['pays','=',$request['pays']],
            ])
            ->orderBy('nom_club')
            ->get();

        return response()->json(['clubs' => $clubs]);
    }

    public function simulationResultat($url_club_choisis , $anneechoisis)
    {
        /***** INFO CLUB DOMICILE & EXTERIEUR *****/
        $clubChoisis = DB::table('clubs')
            ->where([
                ['url_nom','=',$url_club_choisis],
            ])
            ->first();

        $choixAnnee = DB::table('rencontres')
            ->select('annee')
            ->groupBy('annee')
            ->pluck('annee');

        $clubAdverse = DB::select('SELECT clubs.* 
        FROM clubs 
        WHERE clubs.id_club in (
        SELECT equipe_exterieur 
        FROM rencontres 
        WHERE equipe_domicile =  '.$clubChoisis -> id_club  .' )
        OR clubs.id_club in (
        SELECT equipe_domicile
        FROM rencontres
        WHERE equipe_exterieur  = '.$clubChoisis ->id_club.'
        )');




        /***** ANCIENNES RENCONTRES *****/
        $rencontres = DB::select('SELECT * FROM rencontres 
        WHERE (equipe_domicile = '.$clubChoisis->id_club.' AND annee='.$anneechoisis.'
         ) 
        OR 
        (equipe_exterieur = '.$clubChoisis->id_club.' AND annee='.$anneechoisis.')
        ORDER BY id_match DESC
        LIMIT 5');


        $nbPrisDomicile = DB::table('rencontres')->where([
            ['equipe_domicile' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis]
        ])->sum('but_exterieur');

        $nbPrisExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis]
        ])->sum('but_domicile');

        $nbPrisTot = $nbPrisDomicile  +$nbPrisExterieur;

        /***** BUTS DOMICILES *****/

        $nbButDomicile = DB::table('rencontres')->where([
            ['equipe_domicile', '=', $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis]
        ])->sum('but_domicile');



        /***** BUTS EXTERIEURS *****/
        $nbButExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis]
            ])->sum('but_exterieur');

        /***** BUTS TOTALS *****/
        $nbButTot = $nbButDomicile + $nbButExterieur;

        /****Matchs gagnes domicile ***/
        $nbMatchWinDom = DB::table('rencontres')->where([
         ['equipe_domicile' , '=' , $clubChoisis->id_club],
         ['annee' , '=' , $anneechoisis],
         ['but_domicile' , '>' , 'but_exterieur']
        ])->count();


        /****Matchs gagnes exterieur***/
        $nbMatchWinExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis],
            ['but_domicile' , '<' , 'but_exterieur']
        ])->count();

        /*****Matchs gagnes totals***/
        $nbVictoire = $nbMatchWinDom  + $nbMatchWinExterieur;


        /*****Matchs perdus domicile***/
        $nbMatchDefDom = DB::table('rencontres')->where([
            ['equipe_domicile' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis],
            ['but_domicile' , '<' , 'but_exterieur']
        ])->count();


        /*****Matchs perdus exterieurs***/
        $nbMatchDefExterieur= DB::table('rencontres')->where([
            ['equipe_domicile' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis],
            ['but_domicile' , '>' , 'but_exterieur']
        ])->count();

        /*****Matchs perdus totals***/
        $nbDefaite  = $nbMatchDefDom + $nbMatchDefExterieur;

        /*********Matchs nuls domicile****/
        $nbMatchNulDom = DB::table('rencontres')->where([
            ['equipe_domicile' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis],
            ['but_domicile' , '=' , 'but_exterieur']
        ])->count();

        $nbMatchNulExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur' , '=' , $clubChoisis->id_club],
            ['annee' , '=' , $anneechoisis],
            ['but_domicile' , '=' , 'but_exterieur']
        ])->count();

        $nbNul = $nbMatchNulDom + $nbMatchNulExterieur;






        /***** RETURN FUNCTION *****/
        return view('statEquipe', [
            'clubChoisis' => $clubChoisis,
            'rencontres' => $rencontres,
            'clubAdverse' => $clubAdverse,
            'nbButTot' => $nbButTot,
            'nbButDomicile' => $nbButDomicile,
            'nbButExterieur' => $nbButExterieur,
            'nbPrisExterieur' => $nbPrisExterieur,
            'nbPrisDomicile' => $nbPrisDomicile,
            'nbPrisTot' => $nbPrisTot,
            'nbVictoire' => $nbVictoire,
            'nbMatchWinExterieur' => $nbMatchWinExterieur,
            'nbMatchWinDom' => $nbMatchWinDom,
            'nbMatchDefDom' => $nbMatchDefDom,
            'nbMatchDefExterieur' => $nbMatchDefExterieur,
            'nbDefaite' => $nbDefaite,
            'nbMatchNulDom' => $nbMatchNulDom,
            'nbMatchNulExterieur' => $nbMatchNulExterieur,
            'nbNul' => $nbNul,
            'anneechoisis' =>$anneechoisis,
            'choixAnnee' => $choixAnnee,

        ]);
    }

    public function getFactorial($num)
    {
        $res = 1;
        for ($n = $num; $n >= 1; $n--)
            $res = $res*$n;
        return $res;
    }
}
