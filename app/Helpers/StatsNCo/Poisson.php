<?php
//app/Helpers/StatsNCo/Poisson.php
namespace App\Helpers\StatsNCo;

use Illuminate\Support\Facades\DB;

class Poisson
{
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function get_force($id_club_domicile, $id_club_exterieur)
    {
        $equipeDom = DB::table('clubs')->where('id_club', $id_club_domicile)->first();
        $equipeExt = DB::table('clubs')->where('id_club', $id_club_exterieur)->first();
        $nbButClubDomicile = DB::table('rencontres')->where([
            ['equipe_domicile', '=', $id_club_domicile],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbButClubDomPrisExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur', '=', $id_club_domicile],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchClubDomicile = DB::table('rencontres')->where([
            ['equipe_domicile', '=', $id_club_domicile],

        ])->count();
        $nbMatchClubDomAExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur', '=', $id_club_domicile],
            ['annee', '=', '2016']
        ])->count();
        $nbButDomicile = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchDomicile = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->count();
        $calcDomicileEquipe = $nbButClubDomicile / $nbMatchClubDomicile;
        $calcDomicileTotal = $nbButDomicile / $nbMatchDomicile;
        $calcConcedeEquipe = $nbButClubDomPrisExterieur / $nbMatchClubDomAExterieur;

        $nbButClubExterieur = DB::table('rencontres')->where([
            ['equipe_domicile', '=', $id_club_exterieur],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbButClubExtPrisExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur', '=', $id_club_exterieur],
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchClubExtDomicile = DB::table('rencontres')->where([
            ['equipe_domicile', '=', $id_club_exterieur],
            ['annee', '=', '2016']
        ])->count();
        $nbMatchClubExtExterieur = DB::table('rencontres')->where([
            ['equipe_exterieur', '=', $id_club_exterieur],
            ['annee', '=', '2016']
        ])->count();
        $nbButDomicile2 = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->sum('but_domicile');
        $nbMatchDomicile2 = DB::table('rencontres')->where([
            ['annee', '=', '2016']
        ])->count();

        $calcExterieurEquipe = $nbButClubExterieur / $nbMatchClubExtDomicile;
        $calcExterieurTotal = $nbButDomicile2 / $nbMatchDomicile2;
        $calcConcedeEquipeExt = $nbButClubExtPrisExterieur / $nbMatchClubExtExterieur;

        $U = ($calcExterieurEquipe / $calcExterieurTotal) * ($calcConcedeEquipe / $calcDomicileTotal) * ($calcDomicileEquipe / $calcDomicileTotal);
        $U2 = ($calcDomicileEquipe / $calcDomicileTotal) * ($calcConcedeEquipeExt / $calcExterieurTotal) * ($calcExterieurEquipe / $calcExterieurTotal);

        $forceAttDomicile = number_format($calcDomicileEquipe / $calcDomicileTotal, 2);
        $forceAttExterieur = number_format($calcConcedeEquipe / $calcDomicileTotal, 2);
        $potentielDefDomicile = number_format($calcExterieurEquipe / $calcExterieurTotal, 2);
        $potentielDefExterieur = number_format($calcConcedeEquipeExt / $calcExterieurTotal, 2);

        $result = [
            "Domicile" => [
                "Id Equipe Domicile" => $equipeDom->id_club,
                "Equipe Domicile" => $equipeDom->nom_club,
                "attaque" => $forceAttDomicile,
                "defense" => $potentielDefDomicile,
                "U" => $U
            ],
            "Exterieur" => [
                "Id Equipe Exterieur" => $equipeExt->id_club,
                "Equipe Domicile" => $equipeExt->nom_club,
                "attaque" => $forceAttExterieur,
                "defense" => $potentielDefExterieur,
                "U2" => $U2
            ]
        ];
        ;
        return (isset($result) ? $result : '');
    }

    public static function get_poisson($id_club_domicile, $id_club_exterieur)
    {
        $infos = self::get_force($id_club_domicile, $id_club_exterieur);
        $tabProbButDomicile = array();
        $tabProbButExterieur = array();
        for($i = 0; $i <= 5; $i++) {
            $tabProbButDomicile[] = (((exp(-$infos['Domicile']['U']))*(pow($infos['Domicile']['U'],$i)))/(self::getFactorial($i)))*100;
            $tabProbButExterieur[] = (((exp(-$infos['Exterieur']['U2']))*(pow($infos['Exterieur']['U2'],$i)))/(self::getFactorial($i)))*100;
        }
        $result = [
            "Domicile"=>$tabProbButDomicile,
            "Extieur"=>$tabProbButExterieur
        ];

        return (isset($result) ? $result : '');

    }
    public static function getFactorial($num)
    {
        $res = 1;
        for ($n = $num; $n >= 1; $n--)
            $res = $res*$n;
        return $res;
    }
}