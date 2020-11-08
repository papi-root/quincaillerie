<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $fillable = ['id_fournisseur', 'id_produit', 'quantite', 'montant', 'created_at', 'updated_at'];
}
