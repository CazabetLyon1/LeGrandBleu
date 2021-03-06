<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Poisson;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($usr_login)
    {
        /*$user = User::where('login','like',$usr_login)->first();*/
        $attEquipe = null;
        $defEquipe = null;
        $user = DB::table('users')
            ->leftJoin('accounts_images','accounts_images.id','=','users.accounts_image_id')
            ->leftJoin('clubs','clubs.id_club','=','users.club_id')
            ->select('users.id','users.accounts_image_id','users.login','users.first_name','users.last_name','users.email','users.birthday','accounts_images.avatar_url', 'clubs.id_club', 'clubs.nom_club', 'clubs.url_club', 'clubs.nom_ville', 'clubs.nom_ville', 'clubs.pays')
            ->where('login','like',$usr_login)->first();
        if($user === null) {
            return abort(404, 'Bad User Login');
        }else{
            if($user->id_club === null){
                $user->url_club = "STATS&CO/default_imgs/club-img-default.png";
                $attEquipe =  "" ;
                $defEquipe =  "";
                $user->attEquipe = $attEquipe;
                $user->defEquipe = $defEquipe;
            }else{

                $equipe = Poisson::get_force_equipe($user->id_club);
                $attEquipe =  $equipe['attaque'] ;
                $defEquipe =  $equipe['defense'];
                $user->attEquipe = $attEquipe;
                $user->defEquipe = $defEquipe;
            }

            if($user->accounts_image_id === null){
                $user->avatar_url = "STATS&CO/default_imgs/img-usr-default.png";
            }


            return view('User.user', compact('user'));
        }
    }

    public function parameters($usr_login){
        $user = DB::table('users')->where('login','like',$usr_login)->first();
        //dd($user);
        return view('User.parameters', compact('user'));
    }

    public function changeUserImage(Request $request)
    {
        $accounts_images = DB::table('accounts_images')
            ->where('accounts_images.id','=', $request['imgId'])->first();
        if($accounts_images === null){
            return response()->json(['data' => 'error image doen\'t exist']);
        }else{
            $user = User::find(Auth::id());
            $user->accounts_image_id = $request['imgId'];
            $user->update();

            return response()->json(['data' => $accounts_images]);
        }
    }

    public function findTeam(Request $request)
    {
        $teamPays = DB::table('clubs')->where('pays','=',$request['nom_club'])->count();
        if($teamPays != 0){
            $team = DB::table('clubs')
                ->where('pays', 'like', $request['nom_club'])
                ->select('clubs.id_club as id','clubs.nom_club as nom','clubs.url_club as img')
                ->get();
        }else{
            $team = DB::table('clubs')
                ->where('nom_club', 'like', $request['nom_club'].'%')
                ->select('clubs.id_club as id','clubs.nom_club as nom','clubs.url_club as img')
                ->get();
        }
        return response()->json(['data' => $team]);
    }
    public function changeTeam(Request $request){
        $club = DB::table('clubs')
            ->where('clubs.id_club','=', $request['club_id'])->first();
        if($club === null){
            return response()->json(['data' => 'error clubs doen\'t exist']);
        }else{
            $user = User::find(Auth::id());
            $user->club_id = $request['club_id'];
            $user->update();
            $equipe = Poisson::get_force_equipe($user->club_id);
            $attEquipe =  $equipe['attaque'] ;
            $defEquipe =  $equipe['defense'];
            $club->attEquipe = $attEquipe;
            $club->defEquipe = $defEquipe;
            return response()->json(['data' => $club]);
        }
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
    public static function admin_credential_rules(array $data)
    {
        $messages = [
            'old_password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
        ];

        $validator = Validator::make($data, [
            'old_password' => 'required',
            'password' => 'required|same:password',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        return $validator;
    }
    public function update(Request $request, $usr_login)
    {

        if(Auth::Check()) {
            $user = User::where("login", "=", $usr_login)->first();
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->birthday = $request['birthday'];
            $message = [];
            if ($request['old_password'] != "") {
                $validator = $this->admin_credential_rules($request->All());
                if (!$validator->fails()) {
                    $current_password = $user->password;
                    if (password_verify($request['old_password'], $current_password)) {
                        $user->password = bcrypt($request->password);
                    }else{
                        $error = array('old_password' => 'Please enter correct current password');
                        return Redirect()->back()->withErrors($error)->withInput();
                    }
                }else {
                    return Redirect()->back()->withErrors($validator)->withInput();
                }
            }
            $user->update();

        }
        return redirect()->back()->with("update","compte mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($usr_login)
    {
        $user = User::where("login", "=", $usr_login)->first();
        $user->delete();
        return redirect('login');
    }
}
