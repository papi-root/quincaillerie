<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serveuse;
use Session;

class ServeuseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $serveuses = Serveuse::all();

        return view('serveuse.index')->with('serveuses', $serveuses);
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
        $this->validate($request, [
          'prenom' => 'required'
        ]);
        Serveuse::create([
          'prenom' => $request->prenom
        ]);

        Session::flash('success', 'Ajouté avec succée !');
        return redirect()->route('serveuses.index');
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
        $s = Serveuse::find($id);

        return view('serveuse.edit')->with('s', $s);
    }

    public function modifier(Request $request, $id)
    {
      $serveuse = Serveuse::find($id);
      $serveuse->prenom = $request->prenom;
      $serveuse->save();

      Session::flash('success', 'Serveuse modifiè avec succèe !');
      return redirect()->route('serveuses.index');
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

    public function supprimer(Request $request)
    {

      Serveuse::destroy($request->id_serveuse);

      Session::flash('success', 'Supprimé avec succée !');

      return redirect()->back();
    }
}
