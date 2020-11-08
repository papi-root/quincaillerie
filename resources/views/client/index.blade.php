@extends('layouts.dashboard')
@section('content')

    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">

    <div class="card card-default">
      <div class="card-header text-center">
        <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">CLIENTS</h4>
      </div>

      <div class="row">
          <div class="col-md-4 col-sm-3">
          <a href="#"
                class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU CLIENT</a>
          </div>
    </div>
    <br>
      <div class="card-body">
        <table class="table table-striped" id="datatable">
          <thead>
            <th>Nom</th>
            <th>Prenom</th>
            <th>TELEPHONE</th>
            <th>Action</th>
          </thead>
          <tbody id="tbody">
          @if($clients->count() > 0)
            @foreach($clients as $c)
                <tr>
                  <td>{{ $c->nom}}</td>
                  <td>{{ $c->prenom }}</td>
                  <td>{{ $c->telephone }}</td>
                  <td>
                    <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$c->id}}"
                       data-nom="{{$c->nom }}" data-prenom="{{$c->prenom}}"
                       data-telephone="{{$c->telephone}}">
                        <i class="fa fa-eye"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('client.edit', $c->id) }}" class="btn btn-warning btn-sm"
                       data-id="{{$c->id}}" data-nom="{{$c->name }}" data-prenom="{{$c->prenoml}}"
                       data-email="{{$c->email}}" data-niveau="{{$c->niveau}}">
                       <i class="fa fa-pencil"></i>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;

                    <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_client1="{{$c->id}}">
                        <i class="fa fa-trash" style="font-size: 18px;"></i>
                    </a>&nbsp;
                  </td>
                </tr>
            
            @endforeach
          @else
            <tr>
              <td colspan="5" class="text-center"> Aucun Client !</td>
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
                      <label for="">TELEPHONE</label>
                      <input type="val" class="form-control" id="telephone" disabled>
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
                <form method="post" action="{{ route('client.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Nom : </label>
                        <div class="col-md-6"><input type="text" name="nom" class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" value="{{ old('nom')}}">
                          @if($errors->has('nom'))
                          <div class="text-center text-danger">
                            {{ $errors->first('nom') }}
                          </div>
                          @endif
                        </div>

                        <div class="clearfix"></div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-3">Prenom : </label>
                        <div class="col-md-6"><input type="text" name="prenom" class="form-control {{ $errors->has('prenom') ? ' is-invalid' : '' }}" value="{{ old('prenom')}}">
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
                          <label class="col-md-3">Telephone : </label>
                            <div class="col-md-6"><input type="telephone" name="telephone" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}" value="{{ old('telephone')}}">
                              @if($errors->has('telephone'))
                              <div class="text-center text-danger">
                                {{ $errors->first('telephone') }}
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
               <form class="text-center" action="{{route('client.supprimer')}}" method="post">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                 <input type="hidden" name="id_client" type="val" id="id_client1">
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
            $('.modal-title').text('Echec de l\'ajout Client !');
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
        $('#telephone').val($(this).data('telephone'));
        $('.modal-title').text('Details Client');
        $('.modal-header').css('background', '#1DC7EA');
    });

    $(document).on('click', '.show-modal-add', function() {
        $('#showmodalAdd').modal('show');
        $('.modal-title').text('Ajouter un client');
        $('.modal-header').css('background', '#1D62F0');
    });

    $(document).on('click', '.show-modal-del', function() {
      $('#showmodalDel').modal('show');
      $('.modal-title').text('Etes-vous sûr de vouloir le supprimer définitivement ?');
      $('#id_client1').val($(this).data('id_client1'));
      $('.modal-header').css('background', 'linear-gradient(90deg, #8E44AD, #3498db)');
    });

    $('#datatable').dataTable();
</script>
@endsection
