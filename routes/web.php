<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
  Route::get('/home', 'HomeController@index')->name('home');

  Route::resource('/produit', 'ProduitController');

  Route::get('produit-delete', [
    'uses' => 'ProduitController@destroy',
    'as' => 'produit.destroy'
  ]);

  Route::post('/stock-AQte', [
      'uses' => 'StockController@ajouterQte',
      'as' => 'stock.AQte'
  ]);

  Route::post('/modifier/{id}', [
    'uses' => 'ProduitController@modifier',
    'as' => 'produit.modifier'
  ]);

  Route::get('/confirmer-facture', [
    'uses' => 'FactureController@facturer',
    'as' => 'confirmer.facture'
    ]);

    Route::get('/confirmer-credit', [
      'uses' => 'FactureController@crediter',
      'as' => 'confirmer.credit'
      ]);
  Route::resource('/vente', 'VenteController');

  Route::resource('/panier', 'PanierController');

  Route::resource('/crediter', 'CreditController');

  Route::resource('/entrees', 'EntreeController');

  Route::post('/entrees-supprimer', [
    'uses' => 'EntreeController@supprimer',
    'as' => 'entrees.supprimer'
  ]);

  Route::post('/entree-modifier/{id}', [
    'uses' => 'EntreeController@modifier',
    'as' => 'entree.modifier'
  ]);

  Route::resource('/sorties', 'SortieController');

  Route::resource('/utilisateur', 'UtilisateurController');

  Route::post('/utilisateur/{id}/modifier', [
    'uses' => 'UtilisateurController@modifier',
    'as' => 'utilisateur.modifier'
  ]);

  Route::post('/utilisateur-supprimer', [
    'uses' => 'UtilisateurController@supprimer',
    'as' => 'utilisateur.supprimer'
  ]);

  Route::resource('/profil', 'ProfilController');

  Route::resource('/accueil', 'AccueilController');

  Route::resource('/stock', 'StockController');

  Route::resource('/total', 'TotalController');

  Route::get('/details/{jour}', [
    'uses' => 'TotalController@details',
    'as' => 'total.details'
  ]);

  Route::get('/total-caissier', [
    'uses' => 'TotalController@totalCaissier',
    'as' => 'total.caissier'
  ]);

  Route::get('/detailsCaissier/{jour}/{caissier}', [
    'uses' => 'TotalController@detailsCaissier',
    'as' => 'total.detailsCaissier'
  ]);

  Route::resource('/reglement', 'ReglementCOntroller');

  Route::post('/reglement/confirmer', [
    'uses' => 'ReglementController@confirmer'
  ]);

  Route::post('/stock-modifier/{id}', [
    'uses' => 'StockController@modifier',
    'as' => 'stock.modifier'
  ]);

  Route::post('/reglement/confirmer', [
    'uses' => 'ReglementController@confirmer',
    'as' => 'reglement.confirmer'
  ]);

  Route::post('/crediter-versement', [
    'uses' => 'CreditController@versement',
    'as' => 'crediter.versement'
  ]);

  Route::post('stock-supprimer', [
    'uses' => 'StockController@supprimer',
    'as' => 'stock.supprimer'
  ]);

  Route::get('credit-regle', [
    'uses' => 'CreditController@reglement',
    'as' => 'credit.reglement'
  ]);

  Route::post('crediter-details', [
    'uses' => 'CreditController@details',
    'as' => 'crediter.details'
  ]);

  Route::post('/ventes/supprimer/{id}', [
    'uses' => 'VenteController@supprimer',
    'as' => 'ventes.supprimer'
  ]);

  Route::resource('/client', 'ClientController');

  Route::post('/clients/supprimer', [
    'uses' => 'ClientController@supprimer',
    'as' => 'client.supprimer'
  ]); 

  Route::resource('/compte', 'CompteController'); 
  
  Route::post('/compte/AQte', [
    'uses' => 'CompteController@ajouter',
    'as' => 'compte.AQte'
  ]); 

  Route::post('/compte/supprimer', [
    'uses' => 'CompteController@supprimer',
    'as' => 'compte.supprimer'
  ]); 

    Route::resource('/articleclient', 'ArticleClientController'); 

    Route::get('/articleclient/afficher/{id}', [
      'uses' => 'ArticleClientController@afficher',
      'as' => 'articleclient.afficher'
    ]);

    Route::resource('/depense', 'DepenseController');
    
    Route::post('/depense/supprimer', [
      'uses' => 'DepenseController@supprimer',
      'as' => 'depense.supprimer'
    ]); 

    Route::resource('/fournisseur', 'FournisseurController');

    Route::post('/fournisseur/supprimer', [
      'uses' => 'FournisseurController@supprimer',
      'as' => 'fournisseur.supprimer'
    ]);
    
    Route::post('/fournisseur/modifier/{id}', [
      'uses' => 'FournisseurController@modifier',
      'as' => 'fournisseur.modifier'
    ]); 


});
