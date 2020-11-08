<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\user;

class AccueilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $mois = Carbon::now()->year .'-'. Carbon::now()->month;

        /*
          $entree = DB::table('entrees')->select('mois', DB::raw('SUM(montant) as depenses'))
          ->groupBy('mois')->where('mois', '=', $mois)->get();
          */
        $credits = DB::table('credits')->select( DB::raw('SUM(montant) as total'))->where('montant', '!=', 'versement')->get();
        $sorties = DB::table('ventes')->select('mois', DB::raw('SUM(montant) as total'))
          ->groupBy('mois')->where('mois', '=', $mois)->get();


        $ventes = DB::table('ventes')
        ->select('mois', DB::raw('SUM(montant) as montant'))
        ->groupBy('mois')->where('reglement', '=', 1)
        ->get();

        $tableau = [];
        foreach ($ventes as $key => $v)
        {
          if(Carbon::parse($v->mois)->year == Carbon::now()->year)
          {
            if(Carbon::parse($v->mois)->month == 1)
            {
              $tableau[1] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 2)
            {
              $tableau[2] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 3)
            {
              $tableau[3] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 4)
            {
              $tableau[4] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 5)
            {
              $tableau[5] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 6)
            {
              $tableau[6] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 7)
            {
              $tableau[7] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 8)
            {
              $tableau[8] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 9)
            {
              $tableau[9] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 10)
            {
              $tableau[10] = $v->montant;
            }
            else if(Carbon::parse($v->mois)->month == 11)
            {
              $tableau[11] = $v->montant;
            }
            else
            {
              $tableau[12] = $v->montant;
            }
          }
        }

        $user = User::all();
        $nbreUser = $user->count();

        if($credits->count() == 0)
        {
          $credit = 0;
        }
        else
        {
          $credit = $credits[0]->total;
        }

        if( $sorties->count() == 0)
        {
          $sortie = 0;
        }
        else
        {
          $sortie = $sorties[0]->total;
        }

        if($ventes->count() == 0)
        {
          $ventes = 0;
        }
        else
        {
          $ventes = $ventes[0]->montant;
        }

        return view('accueil.index')
                ->with('nbreUser', $nbreUser)->with('sortie', $sortie)
                ->with('ventes', $ventes)->with('tableau', $tableau)->with('credit', $credit);
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
