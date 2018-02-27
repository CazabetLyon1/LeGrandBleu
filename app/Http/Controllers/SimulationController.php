<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Club;
use Charts;

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
                ['url_club','=',$url_club_domicile],
            ])
            ->first();

        $clubExterieur = DB::table('clubs')
            ->where([
                ['url_club','=',$url_club_exterieur],
            ])
            ->first();

        /***** ANCIENNES RENCONTRES *****/
        $rencontres = DB::select('SELECT * FROM rencontres 
        WHERE (equipe_domicile = '.$clubDomicile->id_club.' AND equipe_exterieur = '.$clubExterieur->id_club.') 
        OR 
        (equipe_domicile = '.$clubExterieur->id_club.' AND equipe_exterieur = '.$clubDomicile->id_club.')
        ORDER BY id_match');

        /***** CHART 1 *****/
        $nbAllMatch = DB::table('rencontres')
            ->where('division','=','F1')
            ->count();

        $nbButDomicile = DB::table('rencontres')
            ->where('division','=','F1')
            ->sum('but_domicile');
        $nbButExterieur = DB::table('rencontres')
            ->where('division','=','F1')
            ->sum('but_exterieur');

        $nbButMoyenMarqueDomicile = $nbButDomicile / $nbAllMatch;
        $nbButMoyenMarqueExterieur = $nbButExterieur / $nbAllMatch;

        $nbButMoyenConcedeDomicile = $nbButMoyenMarqueExterieur;
        $nbButMoyenConcedeExterieur = $nbButMoyenMarqueDomicile;

        // Club Domicile

        //Force d'attaque domicile
        $nbButMarqueClubDomicile = DB::table('rencontres')
            ->where('equipe_domicile','=', $clubDomicile->id_club)
            ->sum('but_domicile');

        $nbMatchClubDomicile = DB::table('rencontres')
            ->where('equipe_domicile','=', $clubDomicile->id_club)
            ->count();

        $forceAttaqueClubDomicile = ($nbButMarqueClubDomicile / $nbMatchClubDomicile) / $nbButMoyenMarqueDomicile;

        //Potentiel défense exterieur
        $nbButConcedeClubExterieur = DB::table('rencontres')
            ->where('equipe_exterieur','=', $clubExterieur->id_club)
            ->sum('but_domicile');

        $nbMatchClubExterieur = DB::table('rencontres')
            ->where('equipe_exterieur','=', $clubExterieur->id_club)
            ->count();

        $potentielDefenseClubExterieur = ($nbButConcedeClubExterieur / $nbMatchClubExterieur) / $nbButMoyenConcedeExterieur;
        $nbButClubDomicile = $forceAttaqueClubDomicile * $potentielDefenseClubExterieur * $nbButMoyenMarqueDomicile;

        // Club Exterieur

        //Force d'attaque exterieur
        $nbButMarqueClubExterieur = DB::table('rencontres')
            ->where('equipe_exterieur','=', $clubExterieur->id_club)
            ->sum('but_exterieur');

        $nbMatchClubExterieur = DB::table('rencontres')
            ->where('equipe_exterieur','=', $clubExterieur->id_club)
            ->count();

        $forceAttaqueClubExterieur = ($nbButMarqueClubExterieur / $nbMatchClubExterieur) / $nbButMoyenMarqueExterieur;

        //Potentiel défense domicile
        $nbButConcedeClubDomicile = DB::table('rencontres')
            ->where('equipe_domicile','=', $clubDomicile->id_club)
            ->sum('but_exterieur');

        $nbMatchClubDomicile = DB::table('rencontres')
            ->where('equipe_domicile','=', $clubDomicile->id_club)
            ->count();

        $potentielDefenseClubDomicile = ($nbButConcedeClubDomicile / $nbMatchClubDomicile) / $nbButMoyenConcedeDomicile;

        $nbButClubExterieur = $forceAttaqueClubExterieur * $potentielDefenseClubDomicile * $nbButMoyenMarqueExterieur;

        // LOI POISSON DOMICILE

        $tabProbButDomicile = array();
        for ($i = 0; $i <= 5; $i++)
        {
            echo ((exp(1) - $nbButClubDomicile) * ($nbButClubDomicile * $i) ) / $this->fact($i).'<br/>';
            //$tabProbButDomicile[] = (exp(1) - $nbButClubDomicile) * ($nbButClubDomicile * $i) / $this->fact($i);
        }

        $chart1 = Charts::multi('line', 'chartjs')
            ->title('')
            ->dimensions(0,200)
            ->colors(['#00ffff', '#a94244'])
            ->labels(['1', '2', '3', '4', '5'])
            ->dataset('Domicile', [50, 30, 20, 20, 19])
            ->dataset('Exterieur', [20, 18, 10, 10, 24]);

        /***** CHART 2 *****/
        $chart2 = $this->chart2($clubDomicile, $clubExterieur);

        /***** RETURN FUNCTION *****/
        return view('simulationResultat', [
            'clubDomicile' => $clubDomicile,
            'clubExterieur' => $clubExterieur,
            'rencontres' => $rencontres,
            'chart1' => $chart1,
            'chart2' => $chart2
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

    public function fact($num)
    {
        $res = 1;
        for ($i = 1; $i <= $num; $i++)
        {
            $res = $res * $i;
        }
        return $res;
    }
}
