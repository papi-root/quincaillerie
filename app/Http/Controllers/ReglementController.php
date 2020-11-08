<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Vente;

class ReglementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $reglements = DB::table('ventes')
        ->select( DB::raw('SUM(montant) as total'), 'serveuse', 'place')
        ->groupBy('place', 'serveuse')
        ->where('reglement', '=', 1)->get();

        return view('reglement.index')->with('reglements', $reglements);

    }

    public function confirmer(Request $request)
    {
      if($request->m_recu == null || $request->m_recu < $request->m_apayer)
      {
        Session::flash('info', 'Le montant saisi est inférieur !');

        return redirect()->back();
      }

      $monnaie = $request->m_recu - $request->m_apayer;

      $produits = DB::table('produits')
      ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
      ->select('produits.libelle', 'produits.prix', 'ventes.id', 'ventes.quantite', 'ventes.montant', 'ventes.serveuse', 'ventes.place')
      ->orderBy('id', 'desc')
      ->where('ventes.reglement', '=', 1)->where('ventes.serveuse', '=', $request->serveuse)
      ->where('ventes.place', '=', $request->place)->get();


      $ventes = Vente::all();
      foreach($ventes as $v)
      {
        if($v->reglement == 1 && $v->serveuse == $request->serveuse && $v->place == $request->place)
        {
          $v->reglement = 2;
          $v->save();
        }
      }

      return view('reglement')->with('m_donnee', $request->m_recu)->with('monnaie', $monnaie)->with('serveuse', $request->serveuse)->with('place',  $request->place)->with('produits', $produits);
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
