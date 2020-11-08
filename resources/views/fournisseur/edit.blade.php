@extends('layouts.dashboard')
@section('content')
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-default">
      <div class="card-header text-center">
      <h3 class="text-center" style="background: #FF9500; color: #fff; padding: 20px;">MODIFICATION DE FOURNISSEUR </h3>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('fournisseur.modifier', $f->id) }}"  enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

           
            <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">RAISON SOCIAL: </label>
                        <div class="col-md-6">
                            <input type="text" name="rs" class="form-control {{ $errors->has('rs') ? ' is-invalid' : '' }}" value="{{ $f->rs }}">
                          @if($errors->has('rs'))
                          <div class="text-center text-danger">
                            {{ $errors->first('rs') }}
                          </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">TELEPHONE : </label>
                        <div class="col-md-6"><input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}" value="{{ $f->telephone}}">
                          @if($errors->has('telephone'))
                          <div class="text-center text-danger">
                            {{ $errors->first('telephone') }}
                          </div>
                          @endif
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Adresse: </label>
                        <div class="col-md-6"><input type="text" name="adresse" class="form-control {{ $errors->has('adresse') ? ' is-invalid' : '' }}" value="{{ $f->adresse }}">
                          @if($errors->has('adresse'))
                          <div class="text-center text-danger">
                            {{ $errors->first('adresse') }}
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
