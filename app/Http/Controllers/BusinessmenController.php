<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Businessmen;

class BusinessmenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessmen = Businessmen::orderBy('created_at', 'DESC')->get();
        
        foreach ($businessmen as $key => $value) {
            $dad_name = Businessmen::where('id',$value->dad_businessmen_id)
                                ->select('name')
                                ->first();
            $businessmen[$key]->dad_name = $dad_name;
        }
        
        return response($businessmen);
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
        $cell = $request->input('cell');
        $existsCell = Businessmen::where('cell', $cell)->first();
        if(!$existsCell){
            $newBusinessmen = new Businessmen;
            $newBusinessmen->name = $request->input('name');
            $newBusinessmen->dad_businessmen_id = $request->input('dad_businessmen_id');
            $newBusinessmen->cell = $request->input('cell');
            $newBusinessmen->state = $request->input('state');
            $newBusinessmen->city = $request->input('city');
            $newBusinessmen->save();
            return response($newBusinessmen, 201);
        }
        return response('celular já cadastrado', 401);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        function getParentes($id) {
            $list = [];
            if(count(Businessmen::where('dad_businessmen_id', $id)->get()) > 0){
                $list = Businessmen::where('dad_businessmen_id', $id)->select('id','name')->get();
                foreach($list as $key => $son){
                    $list[$key]['sons'] = getParentes($son->id);
                }
            }
            return $list;
        };

       

        return response(getParentes($id), 201);
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
        $businessmen = Businessmen::find($id);
        $businessmen->delete();
        return response('ok', 201);
    }
}
