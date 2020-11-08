@extends('layouts.dashboard')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION</h3>
      </div>

      <div class="card-body">
        <form method="post" action="{{ route('utilisateur.modifier' , $u->id) }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Nom : </label>
              <div class="col-md-6"><input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $u->nom }}">
                @if($errors->has('name'))
                <div class="text-center text-danger">
                  {{ $errors->first('name') }}
                </div>
                @endif
              </div>

              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label class="col-md-3">Prenom : </label>
              <div class="col-md-6"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ $u->prenom }}">
                @if($errors->has('prenom'))
                <div class="text-center text-danger">
                  {{ $errors->first('prenom') }}
                </div>
                @endif
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
                <label class="col-md-3">Email : </label>
                <div class="col-md-6"><input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ $u->email }}">
                  @if($errors->has('email'))
                  <div class="text-center text-danger">
                    {{ $errors->first('email') }}
                  </div>
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
          </div>


          <div class="form-group">
            <div class="row">
                <label class="col-md-3">Mot de Passe : </label>
                <div class="col-md-6">
                  <input type="password" name="password" class="form-control" value="{{ old('password')}}">

                  <div class="text-center text-info">
                    Champs Mot de Passe, à remplir si seulement vous voulez le changer.
                  </div>
                </div>
                <div class="clearfix"></div>
              </div>
          </div>

          <div class="form-group">
            <div class="row">
                <label class="col-md-3">Confirmer mot de passe : </label>
                  <div class="col-md-6"><input id="password-confirm" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation">
                    @if($errors->has('password'))
                    <div class="text-center text-danger">
                      {{ $errors->first('password') }}
                    </div>
                    @endif
                  </div>
                <div class="clearfix"></div>
            </div>
          </div>

          @if(Auth::user()->niveau == 1)
            <div class="form-group">
             <div class="row">
                <label class="col-md-3">Perimission : </label>
                <div class="col-md-6">
                  <select class="form-control {{ $errors->has('niveau') ? 'is-invalid' : '' }}" name="niveau">
                    <option value="">Veuillez choisir le niveau de l'utilisateur</option>
                    <option value="1" @if($u->niveau == 1) selected @endif>Niveau 1</option>
                    <option value="2" @if($u->niveau == 2) selected @endif>Niveau 2</option>
                  </select>
                </div>
             </div>
            </div>
          @endif
          <div class="form-group text-center">
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
