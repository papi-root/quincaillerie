<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produit;
use Session;
use App\Entree;
use DB;
use App\Vente;
use App\Stock;

class ProduitController extends Controller
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

        return view('produit.index')
        ->with('produits', $produits);
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
          'prix_achat' => 'required|integer',
          'prix_vente' => 'required|integer',
          'quantite' => 'required|integer',
          'fournisseur' => 'required'
        ]);

        $produits = Produit::all();

        foreach($produits as $produit)
        {
          if($produit->libelle == $request->libelle && $produit->prix_achat == $request->prix_achat && $produit->prix_vente == $request->prix_vente)
          {
            Session::flash('info', 'Ce Produit existe déjà !');
            return redirect()->back();
          }
        }


      /*  if($request->img == null)
        {
          Produit::create([
            'image' => 'plat.jpg',
            'libelle' => $request->libelle,
            'prix' => $request->prix,
            'id_categorie' => $request->categorie,
            'place' => $request->place
          ]);
        }
        else
        {
          $image = $request->img;

          $image_new = time().$image->getClientOriginalName();
          Produit::create([
            'image' => $image_new,
            'libelle' => $request->libelle,
            'prix' => $request->prix,
            'id_categorie' => $request->categorie,
            'place' => $request->place
          ]);
          $image->move('uploads\images', $image_new);
        }
        */

        if($request->unite ==  null)
        {
          $unite = '';
        }
        else
        {
          $unite = $request->unite;
        }
         
        Produit::create([
          'id_fournisseur' => $request->fournisseur, 
          'libelle' => $request->libelle,
          'prix_achat' => $request->prix_achat,
          'prix_vente' => $request->prix_vente,
          'unite' => $unite
        ]);

        $produits = Produit::all();

        foreach($produits as $produit)
        {
          if($produit->libelle == $request->libelle && $produit->prix_achat == $request->prix_achat && $produit->prix_vente == $request->prix_vente)
          {
            Entree::create([
              'id_produit' => $produit->id,
              'quantite' => $request->quantite,
              'montant' => $produit->prix_achat * $produit->montant
            ]);

            Stock::create([
              'id_produit' => $produit->id,
              'quantite' => $request->quantite,
              'montant' => $produit->prix_achat * $produit->montant
            ]);
            break;
          }
        }

        Session::flash('success', 'Produit ajoute avec succee !');

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
        $produit = Produit::find($id);

        return view('produit.edit')->with('p', $produit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier(Request $request, $id)
    {
        //
        $this->validate($request, [
          'libelle' => 'required',
          'prix' => 'required',
          'categorie' => 'required'
        ]);

        $produit = Produit::find($id);
        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        $produit->id_categorie  = $request->categorie;
        $produit->lieu = $request->place;

      /*  if(!empty($request->img))
        {
          $image = $request->img;

          $image_new = time().$image->getClientOriginalName();
          $image->move('uploads\images', $image_new);

          $produit->image = $image_new;
        }
      */

        $produit->save();

        Session::flash('success', 'Produit modifié avec succée !');

        return redirect()->route('produit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        //
      Produit::destroy($request->id_produit);

/*
      $entrees = DB::table('entrees')->select('id_produit')
        ->where('id_produit', '=', $request->id_produit)
        ->get();

      $ent = Entree::all();

      foreach($ent as $e)
      {
        foreach($entrees as $e1)
        {
          if($e->id_produit == $e1->id_produit)
          {
            $e->delete();
          }
        }
      }
*/
      $ventes = DB::table('ventes')->select('id_produit')
        ->where('id_produit', '=', $request->id_produit)
        ->get();

      foreach($ventes as $v)
      {
        if($v->id_produit == $request->id_produit)
        {
          Vente::destroy($v->id);
        }
      }

      Session::flash('success', 'Produit supprimé avec succée !');

      return redirect()->back();
    }
}
