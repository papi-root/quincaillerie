<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    //
    
    protected $fillable = [
        'id', 'libelle', 'montant', 'created_at', 'updated_at'
    ]; 
}
