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
