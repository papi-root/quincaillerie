@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">PRODUIT</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU PRODUIT</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th class="text-center">Libelle</th>
      <th >Prix (FCFA)</th>
      <th>Catégorie</th>
      <th>Place</th>
      <th>Action</th>
    </thead>
    <tbody id="tbody">
      @if($produits->count() > 0)
        @foreach($produits as $p)
          @foreach($categories as $c)
            @if($c->id == $p->id_categorie)
              <tr>
                <td class="text-center"> {{ $p->libelle }}</td>
                <td> {{ $p->prix }}</td>
                <td> {{ $c->libelle }}</td>
                <td>{{ $p->lieu }}</td>
                <td>
                  <a href="#" class="show-modal btn btn-info btn-sm"
                    data-id="{{$p->id}}" data-libelle="{{$p->libelle}}"
                    data-prix="{{$p->prix}}"
                    data-quantite="{{$p->quantite}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="{{route('produit.edit', $p->id)}}" class="btn btn-warning btn-sm" data-id="">
                      <i class="fa fa-pencil"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_produit1="{{$p->id}}">
                      <i class="fa fa-trash" style="font-size: 18px;"></i>
                  </a>&nbsp;
                </td>
              </tr>
              @endif
            @endforeach
          @endforeach
        @else
          <tr>
            <td colspan="5" class="text-center"> Aucun produit !</td>
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
                <label for="">LIBELLE </label>
                <input type="val" class="form-control" id="libelle" disabled>
            </div>

            <div class="form-group">
                <label for="">PRIX </label>
                <input type="val" class="form-control" id="prix" disabled>
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
          <form method="post" action="{{ route('produit.store') }}"  enctype="multipart/form-data">
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
                <label class="col-md-3">Categorie : </label>
                <div class="col-md-6">
                  <select class="form-control" name="categorie">
                    @foreach($categories as $c)
                      <option value="{{$c->id}}">{{ $c->libelle }}</option>
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
                  <option value="salle">Salle</option>
                  <option value="bar">Bar</option>
                </select>
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

<!-- DELETE FORM -->
<div id="showmodalDel" class="modal fade" role="dialog" tabindex="-1" >
 <div class="modal-dialog" >
     <div class="modal-content">
         <div class="modal-header" style="background: #1D62F0;">
           <h4 class="modal-title text-center" style="color: #fff;"></h4>
         </div>
         <div class="modal-body">
           <form class="text-center" action="{{route('produit.destroy')}}" method="get">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="id_produit" type="val" id="id_produit1">
             <button type="button" data-dismiss="modal" class="btn btn-success">Annuler</button>
             <input type="submit" class="btn btn-danger" value="Confimer">
           </form>
         </div>
     </div>
 </div>
</div>


<script>
// Show function utilisateur
$(document).on('click', '.show-modal', function() {
  $('#showmodalF').modal('show');
  $('#id').val($(this).data('id'));
  $('#libelle').val($(this).data('libelle'));
  $('#prix').val($(this).data('prix'));
  $('.modal-title').text('Details Produit');
  $('.modal-header').css('background', '#1DC7EA');
});

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter un produit');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_produit1').val($(this).data('id_produit1'));
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
