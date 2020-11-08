@extends('layouts.dashboard')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION PRODUIT </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('produit.modifier', $p->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Libelle: </label>
                <div class="col-md-6">
                  <input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{$p->libelle}}">
                  @if($errors->has('libelle'))
                  <div class="text-center text-danger">
                    {{ $errors->first('libelle') }}
                  </div>
                  @endif
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Prix: </label>
                <div class="col-md-6"><input type="text" name="prix" class="form-control {{ $errors->has('prix') ? ' is-invalid' : '' }}" value="{{ $p->prix}}">
                  @if($errors->has('prix'))
                  <div class="text-center text-danger">
                    {{ $errors->first('prix') }}
                  </div>
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="form-group">

            <div class="row">
              <label class="col-md-3">Catégorie : </label>
              <div class="col-md-6">
                <select class="form-control" name="categorie">
                  @foreach(App\Categorie::all() as $c)
                    <option value="{{$c->id}}"
                      @if($c->id == $p->id_categorie) selected @endif>{{ $c->libelle }}</option>
                  @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>

          <div class="row">
            <label class="col-md-3">Place: </label>
            <div class="col-md-6">
              <select class="form-control" name="place">
                <option value="salle" @if($p->place == 'salle') selected @endif >Salle</option>
                <option value="bar" @if($p->place == 'bar') selected @endif >Bar</option>
              </select>
            </div>
            <div class="clearfix"></div>
          </div>

          <div class="form-group text-center">
            <input type="submit" class="btn btn-warning" value="MODIFIER" style="background: #FF9500; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
          </div>
          </form>
      </div>
    </div>
  </div>
</section>

@endsection
