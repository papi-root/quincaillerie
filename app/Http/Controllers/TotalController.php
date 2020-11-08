<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TotalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $total = DB::table('ventes')->select('jour' ,DB::raw('SUM(montant) as total'))
        ->groupBy('jour')->where('reglement', '=', 1)->orderby('jour','desc')->get();

        return view('total.index')->with('total', $total);

    }

    public function totalCaissier()
    {
      $total = DB::table('ventes')->join('users', 'users.id', '=', 'ventes.id_user')->select('ventes.id_user', 'users.nom', 'users.prenom', 'ventes.jour' ,DB::raw('SUM(ventes.montant) as total'))
      ->groupBy('ventes.jour', 'ventes.id_user')->where('ventes.reglement', '=', 1)->orderby('ventes.jour', 'desc')->get();

      return view('total.caissier')->with('total', $total);
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

    public function details($jour)
    {
      $total_salle = DB::table('ventes')->join('produits', 'produits.id', '=', 'ventes.id_produit')
      ->select('ventes.jour', DB::raw('SUM(ventes.montant) as total'))
      ->groupBy('ventes.jour', 'produits.lieu')->where('produits.lieu', '=', 'salle')->where('ventes.jour', '=' , $jour)->where('ventes.reglement', '=', 2)->get();

      $total_bar = DB::table('ventes')->join('produits', 'produits.id', '=', 'ventes.id_produit')
      ->select('ventes.jour', DB::raw('SUM(ventes.montant) as total'))
      ->groupBy('ventes.jour', 'produits.lieu')->where('produits.lieu', '=', 'bar')->where('ventes.jour', '=' , $jour)->where('ventes.reglement', '=', 2)->get();

      if($total_salle->count() == 0)
      {
        $salle = 0;
      }
      else
      {
        $salle = $total_salle[0]->total;
      }

      if($total_bar->count() == 0)
      {
        $bar = 0;
      }
      else
      {
        $bar = $total_bar[0]->total;
      }

      return view('total.details')->with('salle', $salle)
      ->with('bar', $bar);
    }

    public function detailsCaissier($jour, $id_user)
    {
      $total_salle = DB::table('ventes')->join('produits', 'produits.id', '=', 'ventes.id_produit')
      ->join('users', 'users.id', '=', 'ventes.id_user')
      ->select('ventes.jour', DB::raw('SUM(ventes.montant) as total'))
      ->groupBy('ventes.jour')->where('produits.lieu', '=', 'salle')->where('ventes.jour', '=' , $jour)
      ->where('ventes.id_user', '=', $id_user)->where('ventes.reglement', '=', 2)->get();

      $total_bar = DB::table('ventes')->join('produits', 'produits.id', '=', 'ventes.id_produit')
      ->join('users', 'users.id', '=', 'ventes.id_user')
      ->select('ventes.jour', DB::raw('SUM(ventes.montant) as total'))
      ->groupBy('ventes.jour')->where('produits.lieu', '=', 'bar')->where('ventes.jour', '=' , $jour)
      ->where('ventes.id_user', '=', $id_user)->where('ventes.reglement', '=', 2)->get();

      if($total_salle->count() == 0)
      {
        $salle = 0;
      }
      else
      {
        $salle = $total_salle[0]->total;
      }

      if($total_bar->count() == 0)
      {
        $bar = 0;
      }
      else
      {
        $bar = $total_bar[0]->total;
      }

      return view('total.details')->with('salle', $salle)
      ->with('bar', $bar);
    }

}
