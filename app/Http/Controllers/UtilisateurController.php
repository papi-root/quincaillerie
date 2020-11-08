<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $utilisateurs = User::all();

        return view('utilisateur.index')->with('utilisateurs', $utilisateurs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
          'name' => 'required',
          'prenom' => 'required',
          'email' => 'required|unique:users',
          'password' => 'required|confirmed',
          'niveau' => 'required'
        ]);

        User::create([
          'nom' => $request->name,
          'prenom' => $request->prenom,
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'niveau' => $request->niveau
        ]);

        Session::flash('success', 'Utilisateur ajouté avec succée !');
        return redirect()->route('utilisateur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $u = User::find($id);

        return view('utilisateur.edit')->with('u', $u);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier(Request $request, $id)
    {
        //

          $this->validate($request, [
            'name' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'niveau' => 'required'
          ]);

          $utilisateur = User::find($id);

          if($request->email != $utilisateur->email)
          {
            $this->validate($request, [
              'email' => 'unique:users'
            ]);
          }

          $utilisateur->nom = $request->name;
          $utilisateur->prenom = $request->prenom;
          $utilisateur->email = $request->email;

          if(!empty($request->password))
          {
            $this->validate($request, [
              'password' => 'required|confirmed'
            ]);
            $utilisateur->password = bcrypt($request->password);
          }

          $utilisateur->niveau = $request->niveau;
          $utilisateur->save();

          Session::flash('success', 'Utilisateur modifié avec succé !');
          return redirect()->route('utilisateur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function supprimer(Request $request)
    {

      User::destroy($request->id_user);

      Session::flash('success', 'Utilisateur supprimé avec succée !');

      return redirect()->back();
    }
}
