<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class clubUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = DB::table('club')->get();

        return view('Club.table', compact('clubs'));
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
        $this->validate($request, [
            'clubfile' => 'required'
        ]);



        $file = $request->file('clubfile');
        $array = explode('.', $file->getClientOriginalName());
        $extension = end($array);
        if(!empty($file)){
            Storage::disk('public_upload_clubs')->put('/'.$request['pays'].'/'.$request['nom_club'].'.'.$extension, file_get_contents($file));

            $club = DB::table('club')->where('id_club', '=', $request['id_club'])
                ->update(array(
                    'url_club' => 'STATS&CO/Clubs/'.$request['pays'].'/'.$request['nom_club'].'.'.$extension,
                    'nom_image' => $request['nom_club'].'.'.$extension,
                ));
        }
        return \Response::json(array('success' => true, 'url' => 'STATS&CO/Clubs/'.$request['pays'].'/'.$request['nom_club'].'.'.$extension, 'nom' => $request['nom_club'].'.'.$extension ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    public static function getFactorial($num)
    {
        $fact = 1;
        for($i = 1; $i <= $num ;$i++)
            $fact = $fact * $i;
        return $fact;
    }


    public function nbBut()
    {
        //Lyon
        $nbButLyonDomicile = DB::table('rencontre')->where('equipe_domicile','=', 18)->sum('but_domicile');
        $nbButLyonPrisExterieur = DB::table('rencontre')->where('equipe_exterieur','=', 18)->sum('but_domicile');
        $nbMatchLyonDomicile = DB::table('rencontre')->where('equipe_domicile','=', 18)->count();
        $nbMatchLyonExterieur = DB::table('rencontre')->where('equipe_exterieur','=', 18)->count();
        $nbButDomicile = DB::table('rencontre')->sum('but_domicile');
        $nbMatchDomicile = DB::table('rencontre')->count();
        $calcDomicileEquipe = $nbButLyonDomicile/$nbMatchLyonDomicile;
        $calcDomicileTotal = $nbButDomicile/$nbMatchDomicile;
        $calcConcedeEquipe = $nbButLyonPrisExterieur/$nbMatchLyonExterieur;

        $nbButLyonDomicile2 = DB::table('rencontre')->where('equipe_domicile','=', 3)->sum('but_domicile');
        $nbButLyonPrisExterieur2 = DB::table('rencontre')->where('equipe_exterieur','=', 3)->sum('but_domicile');
        $nbMatchLyonDomicile2 = DB::table('rencontre')->where('equipe_domicile','=', 3)->count();
        $nbMatchLyonExterieur2 = DB::table('rencontre')->where('equipe_exterieur','=', 3)->count();
        $nbButDomicile2 = DB::table('rencontre')->sum('but_domicile');
        $nbMatchDomicile2 = DB::table('rencontre')->count();
        $calcDomicileEquipe2 = $nbButLyonDomicile2/$nbMatchLyonDomicile2;
        $calcDomicileTotal2 = $nbButDomicile2/$nbMatchDomicile2;
        $calcConcedeEquipe2 = $nbButLyonPrisExterieur2/$nbMatchLyonExterieur2;
        $U = ($calcDomicileEquipe2/$calcDomicileTotal2) * ($calcConcedeEquipe/$calcDomicileTotal) * ($calcDomicileEquipe/$calcDomicileTotal);
        $U2 =  ($calcDomicileEquipe/$calcDomicileTotal) * ($calcConcedeEquipe2/$calcDomicileTotal2) * ($calcDomicileEquipe2/$calcDomicileTotal2);

        dd(['Paris SG'=> [
            'Paris SG buts à domicile' => $nbButLyonDomicile,
            'Paris SG matchs à domicile' => $nbMatchLyonDomicile,
            'nb Buts à domicile / nb de matchs à domicile' => $calcDomicileEquipe,
            'nb buts à domicile' => $nbButDomicile,
            'nb matchs à domicile' => $nbMatchDomicile,
            'nb Buts à domicile / 2nb de matchs à domicile' => $calcDomicileTotal,
            'FORCE D\'ATT : '.$calcDomicileEquipe.' / '.$calcDomicileTotal => $calcDomicileEquipe/$calcDomicileTotal,
            'Paris SG buts pris à exterieur' => $nbButLyonPrisExterieur,
            'Paris SG matchs à exterieur' => $nbMatchLyonExterieur,
            'nb Buts concede à ext / nb de matchs à exterieur' => $calcConcedeEquipe,
            'FORCE DE DEF : '.$calcConcedeEquipe.' / '.$calcDomicileTotal => $calcConcedeEquipe/$calcDomicileTotal,
            ],

            'Marseille'=>[
            'Marseille buts à domicile' => $nbButLyonDomicile2,
            'Marseille matchs à domicile' => $nbMatchLyonDomicile2,
            'nb Buts à domicile / nb de matchs à domicile' => $calcDomicileEquipe2,
            'nb buts à domicile' => $nbButDomicile2,
            'nb matchs à domicile' => $nbMatchDomicile2,
            'nb Buts à domicile / 2nb de matchs à domicile' => $calcDomicileTotal2,
            'FORCE D\'ATT : '.$calcDomicileEquipe2.' / '.$calcDomicileTotal2 => $calcDomicileEquipe2/$calcDomicileTotal2,
            'real Madrid buts pris à exterieur' => $nbButLyonPrisExterieur2,
            'Marseille matchs à exterieur' => $nbMatchLyonExterieur2,
            'nb Buts concede à ext / nb de matchs à exterieur' => $calcConcedeEquipe2,
            'FORCE DE DEF : '.$calcConcedeEquipe2.' / '.$calcDomicileTotal2 => $calcConcedeEquipe2/$calcDomicileTotal2,
            ],
            'Rencontre : Dom PARIS SG -> Ext MARSEILLE' => [
                'ATT Eqp Ext * DEF Eqp Dom * ATT Eqp Dom' => $U,
                'ATT Eqp Dom * DEF Eqp Ext * ATT Eqp Ext' => $U2,
                'Proba But Lyon' => [
                    '1 but' => (exp(1) - $U)*($U*(1))/$this->getFactorial(1)*10,
                    '2 but' => (exp(1) - $U)*($U*(2))/$this->getFactorial(2)*10,
                    '3 but' => (exp(1) - $U)*($U*(3))/$this->getFactorial(3)*10,
                    '4 but' => (exp(1) - $U)*($U*(4))/$this->getFactorial(4)*10,
                    '5 but' => (exp(1) - $U)*($U*(5))/$this->getFactorial(5)*10
                ],
                'Proba But Marseille' => [
                    '1 but' => (exp(1) - $U2)*($U2*(1))/$this->getFactorial(1)*10,
                    '2 but' => (exp(1) - $U2)*($U2*(2))/$this->getFactorial(2)*10,
                    '3 but' => (exp(1) - $U2)*($U2*(3))/$this->getFactorial(3)*10,
                    '4 but' => (exp(1) - $U2)*($U2*(4))/$this->getFactorial(4)*10,
                    '5 but' => (exp(1) - $U2)*($U2*(5))/$this->getFactorial(5)*10
                ],

            ]
        ]);

    }
/*(exp(1) - $U)($U*1)/*/
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
}
