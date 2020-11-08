<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    // 
    protected $fillable = [
        'id', 'id_client', 'montant', 'crediter', 'restant', 'date', 'date_created', 'date_updated' 
    ]; 
}
