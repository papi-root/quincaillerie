<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Credit;
use App\Vente;
use Session;
use Carbon\Carbon;
use Auth;


class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $credits = DB::table('credits')
        ->select(DB::raw('SUM(montant) as montant'), 'client', 'telephone', 'versement', 'date')
        ->groupBy('client', 'telephone', 'date', 'versement')->get();

        return view('credit.index')->with('credits', $credits);
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
          'telephone' => 'required'
        ]);

        $produits = DB::table('produits')
        ->join('ventes', 'produits.id', '=', 'ventes.id_produit')
        ->select('produits.libelle', 'produits.prix_vente', 'ventes.id_produit', 'ventes.id', 'ventes.quantite', 'ventes.montant')
        ->orderBy('ventes.created_at', 'desc')
        ->where('ventes.reglement', '=', 0)->get();

        $date = Carbon::now()->toDateTimeString();

        foreach($produits as $p)
        {
          Credit::create([
            'id_produit' => $p->id_produit,
            'quantite' => $p->quantite,
            'montant' => $p->montant,
            'versement' => 0,
            'client' => $request->client,
            'telephone' => $request->telephone . ' ',
            'date' => $date
          ]);
        }

        foreach($produits as $p)
        {
          Vente::destroy($p->id);
        }

        $produits = DB::table('produits')
        ->join('credits', 'produits.id', '=', 'credits.id_produit')
        ->select('produits.libelle', 'produits.prix_vente', 'produits.unite' ,'credits.id_produit', 'credits.id', 'credits.quantite', 'credits.montant')
        ->orderBy('credits.created_at', 'desc')
        ->where('credits.versement', '=', 0)->where('credits.client', '=', $request->client)->where('credits.telephone', '=', $request->telephone)->get();

        return view('facture')->with('produits', $produits)->with('facture', 0);
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

    public function versement(Request $request)
    {
      $credits = DB::table('credits')->where('client', '=', $request->client)
      ->where('telephone', '=', $request->telephone)->where('date', '=', $request->date)->get();

      foreach($credits as $c)
      {
        $credit = Credit::find($c->id);
        $credit->versement += $request->versement;

        if($credit->versement > $credit->montant)
        {
          Session::flash('info', 'Le versement est supérieur au montant dû, verifier le reglement saisi !');
          return redirect()->back();
        }

        $credit->save();
      }

      if($credit->versement == $credit->montant)
      {
        $now =  Carbon::now()->toTimeString();
        $yest = Carbon::now();

        if( Carbon::parse($now) > Carbon::parse('00:00:00') && Carbon::parse($now) < Carbon::parse('06:30:00'))
        {
          $yest = Carbon::now()->subday();
        }

        foreach($credits as $c)
        {
          Vente::create([
            'id_produit' => $c->id_produit,
            'quantite' =>  $c->quantite,
            'montant' =>  $c->montant,
            'reglement' => 1,
            'mois' => $yest->year .'-'. $yest->month,
            'jour' => $yest->year .'-'. $yest->month .'-'.  $yest->day,
            'id_user' => Auth::user()->id,
            'facture' => 000
          ]);
        }
      }

      Session::flash('success', 'Opération effectuer avec succée !');
      return redirect()->back();
    }

    public function reglement()
    {
      $credits = DB::table('credits')
      ->select(DB::raw('SUM(montant) as montant'), 'client', 'telephone', 'versement', 'date')
      ->groupBy('client', 'telephone', 'date', 'versement')->get();

      return view('credit.regle')->with('credits', $credits);
    }

    public function details(Request $request)
    {
      $credits = DB::table('credits')->join('produits', 'produits.id', '=', 'credits.id_produit')
      ->select('produits.libelle', 'produits.prix_vente', 'credits.client', 'credits.telephone', 'credits.date', 'credits.montant', 'credits.quantite')
      ->where('credits.client', '=', $request->client)->where('credits.telephone', '=', $request->telephone)
      ->where('credits.date', '=', $request->date)->get();

      return view('credit.details')->with('credits', $credits);
    }
}
