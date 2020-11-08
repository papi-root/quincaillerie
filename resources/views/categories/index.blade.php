@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">CATEGORIES</h4>
</div>

<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU CATEGORIE</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>CATEGORIE</th>
      <th>Action</th>
    </thead>
    <tbody id="tbody">
      @if($categories->count() > 0)
        @foreach($categories as $c)
            <tr>
              <td>{{ $c->libelle }}</td>
              <td>
                <a href="{{ route('categorie.edit', $c->id) }}" class="btn btn-warning btn-sm" data-id="">
                    <i class="fa fa-pencil"></i>
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_categorie1="{{$c->id}}">
                    <i class="fa fa-trash" style="font-size: 18px;"></i>
                </a>&nbsp;
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="5" class="text-center"> Aucun categorie !</td>
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
          <form method="post" action="{{ route('categorie.store') }}">
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
      $('.modal-title').text('Echec de l\'ajout du catégorie !');
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
           <form class="text-center" action="{{route('categorie.supprimer')}}" method="get">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="id_categorie" type="val" id="id_categorie1">
             <button type="button" data-dismiss="modal" class="btn btn-success">Annuler</button>
             <input type="submit" class="btn btn-danger" value="Confimer">
           </form>
         </div>
     </div>
 </div>
</div>


<script>

$(document).on('click', '.show-modal-add', function() {
  $('#showmodalAdd').modal('show');
  $('.modal-title').text('Ajouter un categorie');
  $('.modal-header').css('background', '#1D62F0');
});

$(document).on('click', '.show-modal-del', function() {
  $('#showmodalDel').modal('show');
  $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
  $('#id_categorie1').val($(this).data('id_categorie1'));
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
