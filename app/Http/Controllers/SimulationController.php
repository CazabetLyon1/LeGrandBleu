<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Club;
use App\Charts\SampleChart;

class SimulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pays = DB::select('SELECT DISTINCT pays FROM clubs');
        return view('simulation', ['pays' => $pays]);
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

    public function simulationResultat($url_club_domicile, $url_club_exterieur)
    {
        /***** INFO CLUB DOMICILE & EXTERIEUR *****/
        $clubDomicile = DB::table('clubs')
            ->where([
                ['url_nom','=',$url_club_domicile],
            ])
            ->first();

        $clubExterieur = DB::table('clubs')
            ->where([
                ['url_nom','=',$url_club_exterieur],
            ])
            ->first();

        /***** ANCIENNES RENCONTRES *****/
        $rencontres = DB::select('SELECT * FROM rencontres 
        WHERE (equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.') 
        OR 
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.')
        ORDER BY id_match DESC');

        /***** LOI DE POISSON *****/
        $nbButLyonDomicile = DB::table('rencontres')->where([
                ['equipe_domicile','=', $clubDomicile->id_club],
                ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbButLyonPrisExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur','=', $clubDomicile->id_club],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchLyonDomicile = DB::table('rencontres')->where([
            ['equipe_domicile','=', $clubDomicile->id_club],

        ])->count();
        $nbMatchLyonExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur','=', $clubDomicile->id_club],
            ['annee', '=', '2016']
        ])->count();
        $nbButDomicile = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchDomicile = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->count();
        $calcDomicileEquipe = $nbButLyonDomicile/$nbMatchLyonDomicile;
        $calcDomicileTotal = $nbButDomicile/$nbMatchDomicile;
        $calcConcedeEquipe = $nbButLyonPrisExterieur/$nbMatchLyonExterieur;

        $nbButLyonDomicile2 = DB::table('rencontres')->where([
            ['equipe_domicile','=', $clubExterieur->id_club],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbButLyonPrisExterieur2 = DB::table('rencontres')->where([
            ['equipe_exterieur','=', $clubExterieur->id_club],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchLyonDomicile2 = DB::table('rencontres')->where([
            ['equipe_domicile','=', $clubExterieur->id_club],
            ['annee', '=', '2016']
        ])->count();
        $nbMatchLyonExterieur2 = DB::table('rencontres')->where([
            ['equipe_exterieur','=', $clubExterieur->id_club],
            ['annee', '=', '2016']
        ])->count();
        $nbButDomicile2 = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchDomicile2 = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->count();

        $calcDomicileEquipe2 = $nbButLyonDomicile2/$nbMatchLyonDomicile2;
        $calcDomicileTotal2 = $nbButDomicile2/$nbMatchDomicile2;
        $calcConcedeEquipe2 = $nbButLyonPrisExterieur2/$nbMatchLyonExterieur2;

        $U = ($calcDomicileEquipe2/$calcDomicileTotal2) * ($calcConcedeEquipe/$calcDomicileTotal) * ($calcDomicileEquipe/$calcDomicileTotal);
        $U2 =  ($calcDomicileEquipe/$calcDomicileTotal) * ($calcConcedeEquipe2/$calcDomicileTotal2) * ($calcDomicileEquipe2/$calcDomicileTotal2);

        $forceAttDomicile = number_format($calcDomicileEquipe/$calcDomicileTotal,2);
        $forceAttExterieur = number_format($calcConcedeEquipe/$calcDomicileTotal,2);
        $potentielDefDomicile = number_format($calcDomicileEquipe2/$calcDomicileTotal2,2);
        $potentielDefExterieur = number_format($calcConcedeEquipe2/$calcDomicileTotal2,2);

        $tabProbButDomicile = array();
        $tabProbButExterieur = array();

        for($i = 0; $i <= 5; $i++) {
            $tabProbButDomicile[] = (((exp(-$U))*(pow($U,$i)))/($this->getFactorial($i)))*100;
            $tabProbButExterieur[] = (((exp(-$U2))*(pow($U2,$i)))/($this->getFactorial($i)))*100;
        }

        /***** CHART 1 *****/
        $chart1 = new SampleChart;
        $chart1->labels(['0 but','1 but','2 buts','3 buts','4 buts','5 buts'])
            ->height(200)
            ->options([
                'legend' => [
                    'position' => 'bottom'
                ]
            ]);
        $chart1->dataset($clubDomicile->nom_club, 'bar', $tabProbButDomicile)
            ->options(['borderColor' => '#00ffff']);
        $chart1->dataset($clubExterieur->nom_club, 'bar', $tabProbButExterieur)
            ->options(['borderColor' => '#a94244']);

        /***** RETURN FUNCTION *****/
        return view('simulationResultat', [
            'clubDomicile' => $clubDomicile,
            'clubExterieur' => $clubExterieur,
            'rencontres' => $rencontres,
            'forceAttDomicile' => $forceAttDomicile,
            'forceAttExterieur' => $forceAttExterieur,
            'potentielDefDomicile' => $potentielDefDomicile,
            'potentielDefExterieur' => $potentielDefExterieur,
            'chart1' => $chart1
        ]);
    }

    public function chart2($clubDomicile, $clubExterieur)
    {
        $nbMatch = DB::select('SELECT count(id_match) as nb_match FROM rencontres
        WHERE (equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.')
        OR
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.')
        GROUP BY id_match');
        $nbMatch = count($nbMatch);

        $nbMatchDomicileWin = DB::select('SELECT count(id_match) as nb_match FROM rencontres
        WHERE ((equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.')
        OR
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.'))
        AND resultat = \'H\'
        GROUP BY id_match');
        $nbMatchDomicileWin = count($nbMatchDomicileWin);

        $nbMatchExterieurWin = DB::select('SELECT count(id_match) as nb_match FROM rencontres
        WHERE ((equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.')
        OR
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.'))
        AND resultat = \'A\'
        GROUP BY id_match');
        $nbMatchExterieurWin = count($nbMatchExterieurWin);

        $nbMatchNul = DB::select('SELECT count(id_match) as nb_match FROM rencontres
        WHERE ((equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.')
        OR
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.'))
        AND resultat = \'D\'
        GROUP BY id_match');
        $nbMatchNul = count($nbMatchNul);


        $nbMatchDomicileWin = number_format(($nbMatchDomicileWin * 100) / $nbMatch,2);
        $nbMatchExterieurWin = number_format(($nbMatchExterieurWin * 100) / $nbMatch,2);
        $nbMatchNul = number_format(($nbMatchNul * 100) / $nbMatch, 2);

        $chart2 = Charts::create('donut', 'chartjs')
            ->title('')
            ->labels([$clubDomicile->nom_club, 'Nul', $clubExterieur->nom_club])
            ->colors(['#00ffff', '#a94244', '#18a555'])
            ->values([$nbMatchDomicileWin,$nbMatchExterieurWin,$nbMatchNul])
            ->dimensions(0,200);

        return $chart2;
    }

    public function getFactorial($num)
    {
        $res = 1;
        for ($n = $num; $n >= 1; $n--)
            $res = $res*$n;
        return $res;
    }

    public function getUrl($string)
    {

    }
}
