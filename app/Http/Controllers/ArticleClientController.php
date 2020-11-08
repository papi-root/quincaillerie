<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client; 
use App\Vente; 
use App\Facture; 
use App\Produit;
use App\ArticleClient; 
use DB; 

use App\Compte; 

class ArticleClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

      
    }

    public function afficher($id) 
    {   
  

        $result = DB::table('article_clients')
            ->join('ventes', 'ventes.id', '=', 'article_clients.id_vente')

            ->where('id_compte', '=', $id)->get(); 
      
        $produits = Produit::all(); 

        return view('compte.articleClient')->with('articleclients', $result)->with('produits', $produits);
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
            'client' => 'required'
        ]);

        $compte = DB::table('comptes')->where('id_client', '=', $request->client)->where('montant', '>', 'restant')->orderBy('created_at', 'desc')->get(); 
        
        $compt = Compte::find($compte[0]->id); 
        
        $somme = DB::table('ventes')->select(DB::raw('SUM(montant) as somme'))->where('reglement', '=', 0)->get(); 
        
        if($compt->restant > $somme[0]->somme) 
        {
            $compt->restant = $compt->restant - $somme[0]->somme; 
            $compt->crediter = $compt->crediter + $somme[0]->somme; 
            $compt->save(); 

        } else {
            Session::flash('warning', 'Le restant du compte est inférieur au total '); 
            return redirect()->back(); 
        }

        $produits = DB::table('produits')
      ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
      ->select('produits.libelle', 'produits.prix_vente', 'produits.unite', 'ventes.id', 'ventes.quantite', 'ventes.montant', 'ventes.facture')
      ->orderBy('ventes.created_at', 'desc')
      ->where('ventes.reglement', '=', 0)->get();


      $ventes = Vente::all();
      Facture::create();

      $n = Facture::count();

      foreach($ventes as $v)
      {
        if($v->reglement == 0)
        {
          $v->reglement = 1;
          $v->facture = $n;
          $v->save();

            ArticleClient::create([
                'id_compte' => $compt->id, 
                'id_vente' => $v->id
          ]); 

        }
      }

      return view('facture')->with('produits', $produits)->with('facture', $n);

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
