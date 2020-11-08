<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compte; 
use DB; 
use App\Client; 
use Carbon\Carbon; 
use Session; 

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        //
        $res = DB::table('comptes')
            ->join('clients', 'clients.id', '=', 'comptes.id_client')
            ->select('clients.nom', 'clients.prenom', 'clients.telephone', 'comptes.id', 'comptes.montant', 'comptes.crediter', 'comptes.restant', 'comptes.created_at')
            ->get(); 
       
        return view('compte.index')->with('comptes', $res)->with('clients', Client::all());
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
            'client' => 'required',
            'montant' => 'required|integer'
          ]);
        
          Compte::create([
            'id_client' => $request->client,
            'montant' => $request->montant,
            'crediter' => 0,
            'restant' => $request->montant, 
            'date' => Carbon::now()->toDateString()
          ]); 

          Session::flash('success', 'Operation effectuee avec succees !');

          return redirect()->back();
    }

    public function ajouter(Request $request) 
    {
        $this->validate($request,[
            'montant' => 'required|integer'
        ]); 

        $compte = Compte::find($request->id_compte); 

        $compte->montant  = $compte->montant + $request->montant;
        $compte->restant  = $compte->restant + $request->montant;
        $compte->save();
        
        Session::flash('success', 'Opération effectuée avec succées !');

        return redirect()->back(); 
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

    public function supprimer(Request $request)
    {
        //
    
        Compte::destroy($request->id_compte1);

        Session::flash('success', 'Compte supprimé avec succée !');

        return redirect()->back();
    }
}
