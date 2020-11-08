<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Entree;
use App\Sortie;
use App\Produit;
use Session;
use DB; 

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = DB::table('produits')->join('fournisseurs', 'fournisseurs.id', '=', 'produits.id_fournisseur')->get();
        
        $stocks = Stock::all(); 

        return view('stock.index')->with('stocks', $stocks)->with('produits', $produits);
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
        $stock = Stock::find($request->id_stock);

        $stock->quantite = $stock->quantite - $request->qte_u;

        $stock->save();
        $entree = Entree::find($stock->id_entree);

        Sortie::create([
          'id_entree' => $stock->id_entree,
          'quantite' => $request->qte_u,
          'montant' => $entree->prix * $stock->quantite
        ]);

        Session::flash('success', 'Opération effectuée avec succée !');

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

        $stock = Stock::find($id);
        $produit = Produit::find($stock->id_produit);
        return view('stock.edit')->with('stock', $stock)->with('produit', $produit);
    }

    public function ajouterQte(Request $request)
    {

      $quantite = 0;
      $quantite = (int) $request->quantite;

      $stock = Stock::find($request->id_stock);
      $stock->quantite += $quantite;
      $stock->save();

      $produit = Produit::find($request->id_produit);

      Entree::create([
        'id_produit' => $request->id_produit,
        'quantite' => $quantite,
        'montant' => $produit->prix_achat * $quantite
      ]);

      Session::flash('success', 'Quantité ajouté avec succées !');

      return redirect()->back();
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
        dd($request);
    }

    public function modifier(Request $request, $id)
    {
        //
        $this->validate($request, [
          'libelle' => 'required',
          'prix_achat' => 'required',
          'prix_vente' => 'required',
          'quantite' => 'required'
        ]);

        $stock = Stock::find($id);

        $stock->quantite = $request->quantite;
        $stock->save();

        $produit = Produit::find($stock->id_produit);
        $produit->libelle = $request->libelle;
        $produit->prix_achat = $request->prix_achat;
        $produit->prix_vente = $request->prix_vente;
        $produit->save();

        Session::flash('succes', 'Opération effectuée avec succée !');

        return redirect()->route('stock.index');
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
      $stock = Stock::find($request->id_stock);
      Produit::destroy($stock->id_produit);
      Stock::destroy($request->id_stock);

      Session::flash('success', 'Opération éffectué avec succée !');  
      return redirect()->back();
    }
}
