<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vente;
use App\Produit;
use DB;
use App\Stock;

class PanierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = DB::table('produits')
        ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
        ->select('produits.libelle', 'produits.prix_vente', 'ventes.id', 'ventes.quantite', 'ventes.montant')
        ->orderBy('ventes.created_at', 'desc')
        ->where('ventes.reglement', '=', 0)->get();

        return response()->json($produits);
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
        $vente = Vente::find($id);
        $stock1 = DB::table('stocks')->where('id_produit', '=', $vente->id_produit)->get();
        $stock = Stock::find($stock1[0]->id);
        $stock->quantite += $vente->quantite;

        $stock->save();
        Vente::destroy($id);
        return response()->json(['done']);
    }
}
