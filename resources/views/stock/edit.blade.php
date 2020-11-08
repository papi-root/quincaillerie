@extends('layouts.dashboard')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION DU STOCK </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('stock.modifier', $stock->id) }}"  enctype="multipart/form-data">

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Libelle: </label>
                <div class="col-md-6"><input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{$produit->libelle}}">
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
                <label class="col-md-3">Prix d'achat: </label>
                <div class="col-md-6"><input type="text" name="prix_achat" class="form-control {{ $errors->has('prix_achat') ? ' is-invalid' : '' }}" value="{{$produit->prix_achat}}">
                  @if($errors->has('prix_achat'))
                  <div class="text-center text-danger">
                    {{ $errors->first('prix_achat') }}
                  </div>
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Prix de vente: </label>
                <div class="col-md-6"><input type="text" name="prix_vente" class="form-control {{ $errors->has('prix_vente') ? ' is-invalid' : '' }}" value="{{$produit->prix_vente}}">
                  @if($errors->has('prix_vente'))
                  <div class="text-center text-danger">
                    {{ $errors->first('prix_vente') }}
                  </div>
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

            <div class="form-group">
            <div class="row">
              <label class="col-md-3">Quantité: </label>
                <div class="col-md-6">
                  <input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ $stock->quantite }}">
                  @if($errors->has('quantite'))
                    <div class="text-center text-danger">
                      {{ $errors->first('quantite') }}
                    </div>
                  @endif
                </div>
              <div class="clearfix"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Unité: </label>
                <div class="col-md-6">
                  <select class=" form-control" name="unite">
                    <option @if($produit->unite == '') selected @endif value=""></option>
                    <option value="Kg" @if($produit->unite == 'Kg') selected @endif>Kg</option>
                    <option value="m3" @if($produit->unite == 'm3') selected @endif>m3</option>
                    <option value="m" @if($produit->unite == 'm') selected @endif>m</option>
                  </select>
                </div>
              </div>
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
