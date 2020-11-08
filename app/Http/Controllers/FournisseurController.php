<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur; 
use Session; 

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('fournisseur.index')->with('fournisseurs', Fournisseur::all());
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
           'rs' => 'required',
           'telephone' => 'required',
           'adresse' => 'required'
          ]);
  
        Fournisseur::create([
        'rs' => $request->rs,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse 
        ]);
        
        Session::flash('success', 'Fournisseur ajouté avec succée !');

        return redirect()->route('fournisseur.index');

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
        $f = Fournisseur::find($id);

        return view('fournisseur.edit')->with('f', $f);
    }

    public function modifier(Request $request, $id)
    {
        $this->validate($request, [
            'rs' => 'required',
            'telephone' => 'required',
            'adresse' => 'required'
        ]);
        
        $fourni = Fournisseur::find($id);
        $fourni->rs = $request->rs;
        $fourni->telephone = $request->telephone;
        $fourni->adresse = $request->adresse;

        $fourni->save();
        
        Session::flash('success', 'Opération affectuée avec succée !');

        return redirect()->route('fournisseur.index');
    
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
        Fournisseur::destroy($request->id_fourni); 

        Session::flash('success', 'Opération effectuée avec succées !'); 

        return redirect()->back(); 
    }
}
