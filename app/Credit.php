<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    //
    protected $fillable = [
      'id_produit', 'quantite', 'montant', 'versement', 'client', 'telephone', 'date'
    ];
}
