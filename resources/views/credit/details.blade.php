@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">{{ $credits[0]->client. ' '. $credits[0]->telephone. ' '. $credits[0]->date}}</h4>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>Libelle</th>
      <th>Prix</th>
      <th>Quantité</th>
      <th>Montant</th>
    </thead>
    <tbody id="tbody">
      @if($credits->count() > 0)
        @foreach($credits as $c)

            <tr>
              <td> {{ $c->libelle }}</td>
              <td> {{ $c->prix_vente }}</td>
              <td> {{ $c->quantite }}</td>
              <td> {{ $c->montant }}</td>
            </tr>

          @endforeach
        @else
          <tr>
            <td colspan="7" class="text-center"> Aucun crédit !</td>
          </tr>
        @endif
    </tbody>

  </table>
</div>
</div>

</div>
</section>
 {{--$utilisateurs->links()--}}
{{-- Modal Form Show POST --}}
<div id="showmodalF" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">

            <div class="form-group">
                <label for="">IDENTIFIANT </label>
                <input type="val" class="form-control" id="id" disabled>
            </div>

            <div class="form-group">
                <label for="">NOM </label>
                <input type="val" class="form-control" id="nom" disabled>
            </div>

            <div class="form-group">
                <label for="">PRENOM </label>
                <input type="val" class="form-control" id="prenom" disabled>
            </div>

            <div class="form-group">
                <label for="">LOGIN</label>
                <input type="val" class="form-control" id="login" disabled>
            </div>

            <div class="form-group">
                <label for="">PERMISSION </label>
                <input type="val" class="form-control" id="niveau" disabled>
            </div>
          </div>
      </div>
  </div>
</div>

<div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
  <div class="modal-dialog" >
      <div class="modal-content">
          <div class="modal-header" style="background: #1D62F0;">
            <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">
          <form method="post" action="{{ route('produit.store') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Libelle: </label>
                  <div class="col-md-6"><input type="text" name="libelle" class="form-control {{ $errors->has('libelle') ? 'is-invalid' : '' }}" value="{{ old('libelle')}}">
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
                  <label class="col-md-3">Prix Entrée: </label>
                  <div class="col-md-6"><input type="text" name="prix_entree" class="form-control {{ $errors->has('prix_entree') ? ' is-invalid' : '' }}" value="{{ old('prix_entree')}}">
                    @if($errors->has('prix_entree'))
                    <div class="text-center text-danger">
                      {{ $errors->first('prix_entree') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Prix Sortie: </label>
                  <div class="col-md-6"><input type="text" name="prix_sortie" class="form-control {{ $errors->has('prix_sortie') ? ' is-invalid' : '' }}" value="{{ old('prix_sortie')}}">
                    @if($errors->has('prix_sortie'))
                    <div class="text-center text-danger">
                      {{ $errors->first('prix_sortie') }}
                    </div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>

              <div class="form-group">
              <div class="row">
                <label class="col-md-3">Quantité Entrée: </label>
                  <div class="col-md-6"><input type="text" name="quantite" class="form-control {{ $errors->has('quantite_entree') ? ' is-invalid' : '' }}" value="{{ old('quantite_entree') }}">
                    @if($errors->has('quantite_entree'))
                      <div class="text-center text-danger">
                        {{ $errors->first('quantite_entree') }}
                      </div>
                    @endif
                  </div>
                <div class="clearfix"></div>
                </div>
              </div>

              <div class="form-group  text-center">
                <input type="submit" class="btn btn-primary" value="AJOUTER" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
              </div>
            </form>

          </div>
      </div>
  </div>
</div>

@if($errors->count())
  <script>
    $(document).ready(function() {
      $('#showmodalAdd').modal('show');
      $('.modal-title').text('Echec de l\'ajout du Produit !');
      $('.modal-header').css('background', '#FF4A55');
    });

  </script>
@endif
<script>
  // Show function utilisateur
  $(document).on('click', '.show-modal', function() {
    $('#showmodalF').modal('show');
    $('#id').val($(this).data('id'));
    $('#nom').val($(this).data('nom'));
    $('#prenom').val($(this).data('prenom'));
    $('#login').val($(this).data('login'));
    $('#niveau').val($(this).data('niveau'));
    $('.modal-title').text('Details Utilisateur');
    $('.modal-header').css('background', '#1DC7EA');
  });

  $(document).on('click', '.show-modal-add', function() {
    $('#showmodalAdd').modal('show');
    $('.modal-title').text('Ajouter un produit');
    $('.modal-header').css('background', '#1D62F0');
  });

  $('#datatable').dataTable();
</script>
@endsection
