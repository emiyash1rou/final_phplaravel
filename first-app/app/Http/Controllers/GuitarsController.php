<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuitarsController extends Controller
{
    private static function getData(){
        return [
            ['id' =>1, 'name' =>'American Standard Strat', 'brand' => 'Fender' ],
          ['id' =>2, 'name' =>'Starla', 'brand' => 'PRS' ],
          ['id' =>3, 'name' =>'Mer', 'brand' => 'kun' ],
          ['id' =>4, 'name' =>'Merhamdin', 'brand' => 'kon' ]
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guitars.index',[
                'guitars' => self::getData() ,
                'userInput' => '<script>alert("hello")</script>' ]   );

        // for displaying all of the guitars in database. GET
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // GET
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // POST
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($guitar)
    {
        // GET
        $guitars= self::getData();
        $index = array_search($guitar,array_column($guitars,'id'));
        if($index === false){
            abort(404);
        }else{
            return view('guitars.show',[
                'guitars' => $guitars[$index] ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // GET 
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
        // POST, PUT OR PATCH
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // GET
    }
}
