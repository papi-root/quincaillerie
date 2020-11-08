<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Vente;
use Session;
use DB;
use App\Produit;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categorie::all();

        return view('categories.index')->with('categories', $categories);
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
          'libelle' => 'required'
        ]);

        $categorie = Categorie::all();
        foreach ($categorie as  $c)
        {
          if($c->libelle == $request->libelle)
          {
            Session::flash('info', 'Cette categorie existe deja !');
            return redirect()->back();
          }
        }

        Categorie::create([
          'libelle' => $request->libelle
        ]);

        Session::flash('success', 'Catégorie ajouté avec succée !');
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
        $categorie = Categorie::find($id);

        return view('categories.edit')->with('categorie', $categorie);
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
        //
        $this->validate($request, [
          'libelle' => 'required'
        ]);

        $categorie = Categorie::find($id);
        $categorie->libelle = $request->libelle;
        $categorie->save();

        Session::flash('success', 'Catégorie modifié avec succée !');
          return view('categories.index')->with('categories',  Categorie::all());
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function supprimer(request $request)
    {
        //


        $categorie = Categorie::find($request->id_categorie);

        $produits = DB::table('produits')->where('id_categorie', '=', $request->id_categorie)->get();

        foreach($produits as $p)
        {
          $ventes = DB::table('ventes')->where('id_produit', '=', $p->id)->get();

          foreach($ventes as $v)
          {
              Vente::destroy($v->id);
          }

        }

        foreach($produits as $p)
        {
          Produit::destroy($p->id);
        }

        Categorie::destroy($request->id_categorie);

        Session::flash('success', 'Catégorie supprimé avec succée !');
        return redirect()->back();

    }
}
