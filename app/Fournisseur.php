<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    //
    protected $fillable = [
        'id', 'rs', 'telephone', 'adresse'
    ];
}
