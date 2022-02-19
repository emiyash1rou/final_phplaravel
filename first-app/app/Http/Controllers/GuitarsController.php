<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Guitar;
use App\Http\Requests\GuitarFormRequest;
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
                'guitars' => Guitar::all(),
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
        return view('guitars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuitarFormRequest $request)
    {
        $data = $request->validated();
        // POST
     
        $guitar=new Guitar();
        $guitar->name= $data['guitar-name'];
        $guitar->brand= $data['brand'];
        $guitar->year_made= $data['year-made'];
        $guitar->save();
        return redirect()->route('guitars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guitar $guitar)
    {
        // GET
      
            return view('guitars.show',[
                'guitars' => $guitar->toArray() ,
                'userInput' => '<script>alert("hello")</script>' ]   );
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guitar $guitar)
    {
        // GET 
        return view('guitars.edit',[
            'guitars' =>  $guitar,
            'userInput' => '<script>alert("hello")</script>' ]   );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuitarFormRequest $request, Guitar $guitar)
    {
        // POST, PUT OR PATCH
        
        
        
        $data = $request->validated();

    
        $guitar->name= $data['guitar-name'];
        $guitar->brand= $data['brand'];
        $guitar->year_made= $data['year-made'];
        $guitar->save();
        return redirect()->route('guitars.show',$guitar);
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
