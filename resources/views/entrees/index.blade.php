@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
<h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">ENTREES</h4>
</div>
<br>

<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>Libelle</th>
      <th>Prix</th>
      <th>Quantite</th>
      <th>Unité</th>
      <th>Montant</th>
      <th>Date</th>
    </thead>
    <tbody id="tbody">
      @if($entrees->count() > 0)
        @foreach($entrees as $e)
        @foreach($produits as $p)
          @if($e->id_produit == $p->id)
              <tr>
                <td> {{ $p->libelle }}</td>
                <td> {{ $p->prix_achat }}</td>
                <td> {{ $e->quantite }}</td>
                <td> {{ $p->unite }}</td>
                <td> {{ $p->prix_achat * $e->quantite}}</td>
                <td>{{ $e->created_at }}</td>

              </tr>
              @endif
            @endforeach
          @endforeach
        @else
          <tr>
            <td colspan="6" class="text-center"> Aucun !</td>
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


<div id="showmodalAdd" class="modal fade" role="dialog" tabindex="-1" >
  <div class="modal-dialog" >
      <div class="modal-content">
          <div class="modal-header" style="background: #1D62F0;">
            <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">
          <form method="post" action="{{ route('entrees.store') }}">
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
                  <label class="col-md-3">Prix: </label>
                  <div class="col-md-6"><input type="text" name="prix" class="form-control {{ $errors->has('prix') ? ' is-invalid' : '' }}" value="{{ old('prix')}}">
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
                    <input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ old('quantite') }}">
                    @if($errors->has('quantite'))
                      <div class="text-center text-danger">
                        {{ $errors->first('quantite') }}
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

<!-- DELETE FORM -->
<div id="showmodalDel" class="modal fade" role="dialog" tabindex="-1" >
 <div class="modal-dialog" >
     <div class="modal-content">
         <div class="modal-header" style="background: #1D62F0;">
           <h4 class="modal-title text-center" style="color: #fff;"></h4>
         </div>
         <div class="modal-body">
           <form class="text-center" action="{{route('entrees.supprimer')}}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="id_entree" type="val" id="id_entree1">
             <button type="button" data-dismiss="modal" class="btn btn-success">Annuler</button>
             <input type="submit" class="btn btn-danger" value="Confimer">
           </form>
         </div>
     </div>
 </div>
</div>

@if($errors->count())
  <script>
    $(document).ready(function() {
      $('#showmodalAdd').modal('show');
      $('.modal-title').text('Echec de l\'ajout !');
      $('.modal-header').css('background', '#FF4A55');
    });

  </script>
@endif
<script>

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter une Entrée');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_entree1').val($(this).data('id_entree1'));
  $('.modal-header').css('background', 'linear-gradient(90deg, #8E44AD, #3498db)');
});

</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
  });
});
$('#datatable').dataTable();
</script>
@endsection
