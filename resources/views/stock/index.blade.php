@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">STOCK</h4>
</div>
<br>
<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="#"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>NOUVEAU</a>
    </div>
</div>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>Fournisseur</th>
      <th>Libelle</th>
      <th>Quantite</th>
      <th>Unité</th>
      <th>Date</th>
      <th>Action</th>
    </thead>
    <tbody id="tbody">
      @if($stocks->count() > 0)
        @foreach($stocks as $s)
        @foreach($produits as $p)
          @if($s->id_produit == $p->id)
              <tr class="@if($s->quantite < 8) bg-warning @endif @if($s->quantite < 4) bg-danger @endif">
                <td> {{ $p->rs }} </td>
                <td> {{ $p->libelle }}</td>
                <td> {{ $s->quantite}}</td>
                <td> {{ $p->unite }}</td>
                <td>{{ $s->updated_at }}</td>
                <td>
                  <a href="#" class="show-modal btn btn-info btn-sm"
                    data-id="{{$p->id}}" data-libelle="{{$p->libelle}}" data-prix_achat="{{$p->prix_achat}}"
                    data-prix_vente="{{$p->prix_vente}}" data-quantite="{{$s->quantite}}">
                      <i class="fa fa-eye"></i>
                  </a>&nbsp;&nbsp;&nbsp;&nbsp;

                  <a href="#" data-id_produit="{{ $p->id }}" data-id_stock="{{$s->id}}"
                        class="show-modal-add-qte btn btn-sm btn-success"><i class="fa fa-plus"></i></a>

                    @if(Auth::user()->niveau == 1)
                      <a href="{{route('stock.edit', $s->id)}}" class="btn btn-warning btn-sm" data-id="">
                          <i class="fa fa-pencil"></i>
                      </a>&nbsp;&nbsp;&nbsp;&nbsp;

                      <a href="#" class="show-modal-del btn btn-danger btn-sm" data-id_stock1="{{$s->id}}">
                          <i class="fa fa-trash" style="font-size: 18px;"></i>
                      </a>&nbsp;
                    @endif

                </td>
              </tr>
              @endif
            @endforeach
          @endforeach
        @else
          <tr>
            <td colspan="6" class="text-center"> Stock vide !</td>
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
                <label for="">PRIX D'ACHAT</label>
                <input type="val" class="form-control" id="prix_achat" disabled>
            </div>

            <div class="form-group">
                <label for="">PRIX DE VENTE</label>
                <input type="val" class="form-control" id="prix_vente" disabled>
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
                  <label class="col-md-3">Prix d'achat : </label>
                  <div class="col-md-6"><input type="text" name="prix_achat" class="form-control {{ $errors->has('prix_achat') ? ' is-invalid' : '' }}" value="{{ old('prix_achat')}}">
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
                  <label class="col-md-3">Prix de vente : </label>
                  <div class="col-md-6"><input type="text" name="prix_vente" class="form-control {{ $errors->has('prix_vente') ? ' is-invalid' : '' }}" value="{{ old('prix_vente')}}">
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
                  <div class="col-md-6"><input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ old('quantite') }}">
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
                      <option value=""></option>
                      <option value="Kg">Kg</option>
                      <option value="m3">m3</option>
                      <option value="m">m</option>
                      <option value="m">charette</option>
                      <option value="m">brouette</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label class="col-md-3">Fournisseur: </label>
                  <div class="col-md-6">
                    <select class=" form-control" name="fournisseur">
                      <option value="">Veuillez choisir un fournisseur</option> 
                      @foreach(App\Fournisseur::all() as $f)
                        <option value="{{$f->id}}">{{$f->rs}}</option> 
                      @endforeach
                    </select>
                  </div>
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

<div id="showmodalAddQte" class="modal fade" role="dialog" tabindex="-1" >
  <div class="modal-dialog" >
      <div class="modal-content">
          <div class="modal-header" style="background: #1D62F0;">
            <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
          </div>
          <div class="modal-body">
          <form method="post" action="{{ route('stock.AQte') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_produit" class="form-control" id="id_produit">
              <input type="hidden" name="id_stock" class="form-control" id="id_stock">
              <div class="form-group">
              <div class="row">
                <label class="col-md-3">Quantité: </label>
                  <div class="col-md-6"><input type="text" name="quantite" class="form-control {{ $errors->has('quantite') ? ' is-invalid' : '' }}" value="{{ old('quantite') }}">
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
           <form class="text-center" action="{{route('stock.supprimer')}}" method="post">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" name="id_stock" type="val" id="id_stock1">
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
    $('#prix_achat').val($(this).data('prix_achat'));
    $('#prix_vente').val($(this).data('prix_vente'));
    $('#quantite').val($(this).data('quantite'));
    $('.modal-title').text('Détails Stock');
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
    $('#id_stock1').val($(this).data('id_stock1'));
    $('.modal-header').css('background', 'linear-gradient(90deg, #8E44AD, #3498db)');
  });

  $(document).on('click', '.show-modal-add-qte', function() {
    $('#showmodalAddQte').modal('show');
    $('#id_produit').val($(this).data('id_produit'));
    $('#id_stock').val($(this).data('id_stock'));
    $('.modal-title').text('Ajouter une Quantité');
    $('.modal-header').css('background', '#1D62F0');
  });

  $('#datatable').dataTable();
</script>
@endsection
