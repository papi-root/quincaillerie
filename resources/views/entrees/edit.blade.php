@extends('layouts.dashboard')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION DE L'ENTREE </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('entree.modifier', $entree->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <div class="row">
                <label class="col-md-3">Libelle: </label>
                <div class="col-md-6"><input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{$entree->libelle}}">
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
                <div class="col-md-6"><input type="text" name="prix" class="form-control {{ $errors->has('prix') ? ' is-invalid' : '' }}" value="{{$entree->prix}}">
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
              <label class="col-md-3">Quantité: </label>
                <div class="col-md-6">
                  <input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ $entree->quantite }}">
                  @if($errors->has('quantite'))
                    <div class="text-center text-danger">
                      {{ $errors->first('quantite') }}
                    </div>
                  @endif
                </div>
              <div class="clearfix"></div>
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
