<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Entree;
use Session;
use Carbon\Carbon;
use App\Stock;
use App\Sortie;
use App\Produit;

class EntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = Produit::all();
        $entrees = Entree::all();

        return view('entrees.index')->with('produits', $produits)->with('entrees', $entrees);
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
          'libelle' => 'required',
          'prix' => 'required|integer',
          'quantite' => 'required|integer'
        ]);

        Entree::create([
          'libelle' => $request->libelle,
          'prix' => $request->prix,
          'quantite' => $request->quantite,
          'montant' =>  $request->prix * $request->quantite,
          'mois' => Carbon::now()->year .'-'. Carbon::now()->month
        ]);

        $entree = DB::table('entrees')->where('libelle', '=', $request->libelle)->where('prix', '=', $request->prix)
          ->where('quantite', '=', $request->quantite)->where('montant', '=', $request->prix * $request->quantite)->get();

        Stock::create([
          'id_entree' => $entree[0]->id,
          'prix' => $request->prix,
          'quantite' => $request->quantite,
          'montant' =>  $request->prix * $request->quantite
        ]);

        Session::flash('success', 'Entrée ajouté avec succée !');

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

        $entree = Entree::find($id);

        return view('entrees.edit')->with('entree', $entree);
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

    public function modifier(Request $request, $id)
    {
      $this->validate($request, [
        'libelle' => 'required',
        'prix' => 'required|integer',
        'quantite' => 'required|integer'
      ]);

      $entree = Entree::find($id);

      $entree->libelle = $request->libelle;
      $entree->prix = $request->prix;
      $entree->quantite = $request->quantite;
      $entree->montant = $request->prix * $request->quantite;
      $entree->save();

      Session::flash('success', 'Entrée modifiée avec succée !');

      return redirect()->route('entrees.index');
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
      $sorties = Sortie::all();
      foreach($sorties as $s)
      {
        if($s->id_entree == $request->id_entree)
        {
          Sortie::destroy($s->id);
        }
      }

      $stocks = Stock::all();
      foreach($stocks as $st)
      {
        if($st->id_entree == $request->id_entree)
        {
          Stock::destroy($st->id);
        }
      }

      $entrees = Sortie::all();
      foreach($entrees as $e)
      {
        if($e->id_entree == $request->id_entree)
        {
          Sortie::destroy($s->id);
        }
      }

      Entree::destroy($request->id_entree);

      Session::flash('success', 'Entrées supprimé avec succée !');

      return redirect()->back();
    }
}
