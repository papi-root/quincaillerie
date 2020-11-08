@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<section class="content">

<div class="row">
    <div class="card card-default  col-md-7">
      <div class="card-header text-center">
        <h4>PRODUITS</h4>
      </div>
    <div class="row">
    <br>

    <div class="card-body">
      <table id="datatable" class="table table-striped">
        <thead>
          <th>Categorie</th>
          <th>Libelle</th>
          <th>Prix(FCFA)</th>
          <th>Quantite</th>
          <th>Action</th>
        </thead>
        <tbody id="tbody">
          @if($produits->count() > 0)
            @foreach($produits as $p)
            @if($p->quantite > 0)
                <tr>
                  <td>Categorie</td>
                  <td> {{ $p->libelle }}</td>
                  <td> {{ $p->prix_sortie }}</td>
                  <td> {{ $p->quantite }}</td>
                  <td>

                  <form >

                    <select class="form-control form-control-sm" id="{{$p->id}}">
                      <?php
                        $i = 1;
                        while($i <= $p->quantite)
                        {
                          ?>
                            <option value="{{$i}}">{{$i}}</option>
                          <?php
                          $i++;
                        }
                      ?>
                    </select>

                    <a onclick="ajouter({{$p->id}})" class="btn btn-primary">
                        <i class="pe-7s-cart" style="font-size: 16px;"></i>
                    </a>

                    </form>
                  </td>
                </tr>
                @endif
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

    <div class="card card-default  col-md-5">
      <div class="card-body">
        <table class="table table-striped">
          <thead>
            <th>Libelle</th>
            <th>Prix</th>
            <th>Quantite</th>
            <th>Montant</th>
            <th>Action</th>
          </thead>
          <tbody id="tbody-panier">

          </tbody>
        </table>
      </div>
    </div>

</section>

<script>
  $(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

  $('#datatable').DataTable();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  lister();
  function ajouter(id)
  {

    var qte = $('#'+id).val();

    $.ajax({
      type: 'POST',
      dataType: 'json',
      data: {id:id, qte:qte},
      url: '/vente',
      success: function(response){
        lister();
      }
    });

  }

  function lister()
  {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "/panier",
      success: function(response){
        var rows = "";
        var total = 0;
        $.each(response, function(key, value){
          rows = rows + "<tr>";
          rows = rows + "<td>"+ value.libelle + "</td>";
          rows = rows + "<td>"+ value.prix + "</td>";
          rows = rows + "<td>"+ value.quantite+ "</td>";
          rows = rows + "<td>"+ value.montant+ "</td>";
          rows = rows + "<td><button class='btn btn-danger' onclick='supprimer(" + value.id +")'>Annuler</button></td>";
          rows = rows + "</td></tr>";
          total = total + value.montant;
        });
        if(total != 0)
        {
          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><h4> TOTAL : "+total+" FCFA</h4></td></tr>"
          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><a onclick='redirection();' class='btn btn-primary text-center'>Facturer</a></td></tr>";
        }
        $('#tbody-panier').html(rows);
      }
    });
  }

  function redirection()
  {
    window.location.href='/facture-pdf';
    

  }

  function supprimer(id)
  {
    $.ajax({
      type: "DELETE",
      dataType: "json",
      url: '/panier/'+id,
      success: function(response){
        lister();
      }
    });
  }

</script>
@endsection
