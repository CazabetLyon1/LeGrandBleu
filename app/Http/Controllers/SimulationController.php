<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Charts\SampleChart;
use Poisson;

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
        $loiPoisson = Poisson::get_poisson($clubDomicile->id_club, $clubExterieur->id_club);

        $tabProbFinal = array();
        for ($i = 0;$i <= 5; $i++) {
            for($j = 0; $j <= 5; $j++) {
                $tabProbFinal[] = ($loiPoisson['Domicile']['buts'][$i]) * ($loiPoisson['Exterieur']['buts'][$j]) / 100;
            }
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
        $chart1->dataset($clubDomicile->nom_club, 'bar', $loiPoisson['Domicile']['buts'])
            ->options(['borderColor' => '#00ffff'])
            ->options(['backgroundColor' => '#00ffff']);
        $chart1->dataset($clubExterieur->nom_club, 'bar', $loiPoisson['Exterieur']['buts'])
            ->options(['borderColor' => '#a94244'])
            ->options(['backgroundColor' => '#a94244']);

        /***** RETURN FUNCTION *****/
        return view('simulationResultat', [
            'clubDomicile' => $clubDomicile,
            'clubExterieur' => $clubExterieur,
            'rencontres' => $rencontres,
            'loiPoisson' => $loiPoisson,
            'tabProbFinal' => $tabProbFinal,
            'chart1' => $chart1
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
