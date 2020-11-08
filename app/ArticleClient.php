<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleClient extends Model
{
    //
    protected $fillable = [
        'id', 'id_vente', 'id_compte', 'created_at', 'updated_at'
    ];

}
