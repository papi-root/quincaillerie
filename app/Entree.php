<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    //
    protected $fillable = [
      'id_produit', 'quantite', 'montant', 'reglement', 'mois', 'jour', 'id_user', 'created_at', 'updated_at'
    ];
}
