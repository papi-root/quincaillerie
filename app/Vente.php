<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    //
    protected $fillable = [
      'id_produit', 'quantite', 'montant', 'reglement', 'mois', 'jour', 'id_user', 'facture'
    ];
}
