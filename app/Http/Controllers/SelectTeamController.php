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

    public function simulationResultat($url_club_choisis)
    {
        /***** INFO CLUB DOMICILE & EXTERIEUR *****/
        $clubChoisis = DB::table('clubs')
            ->where([
                ['url_nom','=',$url_club_choisis],
            ])
            ->first();

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
        WHERE (equipe_domicile = '.$clubChoisis->id_club.' ) 
        OR 
        (equipe_exterieur = '.$clubChoisis->id_club.')
        ORDER BY id_match DESC');





        /***** RETURN FUNCTION *****/
        return view('statEquipe', [
            'clubChoisis' => $clubChoisis,
            'rencontres' => $rencontres,
            'clubAdverse' => $clubAdverse

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
