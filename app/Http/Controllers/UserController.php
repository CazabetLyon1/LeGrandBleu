<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = DB::table('users')
            ->leftJoin('accounts_images','accounts_images.id','=','users.accounts_image_id')
            ->select('users.id','users.accounts_image_id','users.login','users.first_name','users.last_name','users.email','users.birthday','accounts_images.avatar_url')
            ->where('login','like',$usr_login)->first();
        if($user === null) {
            return abort(404, 'Bad User Login');
        }else{
            $user->team_img_url = "STATS&CO/default_imgs/club-img-default.png";
            return view('User.user', compact('user'));
        }
    }

    public function changeUserImage(Request $request)
    {
        $accounts_images = DB::table('accounts_images')
            ->where('accounts_images.id','=', $request['imgId'])->first();
        if($accounts_images === null){
            return response()->json(['data' => 'error']);
        }else{
            $user = User::find(Auth::id());
            $user->accounts_image_id = $request['imgId'];
            $user->update();

            return response()->json(['data' => $accounts_images]);
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
