<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    //
    protected $fillable = [ 'id_fournisseur', 'libelle', 'prix_achat','prix_vente', 'unite', 'created_at', 'updated_at']; 
}
