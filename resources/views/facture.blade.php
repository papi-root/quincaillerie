<!DOCTYPE html>
<html lang="en" dir="ltr">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      *
      {
        font-size: 25px;
        font-family: 'Raleway', sans-serif;
      }

      body
      {
        padding: 50px;
      }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-4">
          <img src="{{asset('/uploads/images/fb.png')}}" style="width: 350px;"alt="">
      </div>


      <div class="col-md-6">
        @if($facture != 0)
          <div class="row">
            <h4 style="float:right; font-size:30px;">Facture No. 00{{ $facture }}</h4>
          </div>
        @endif
        <br>
        <h5 style="float:right; font-size:30px;">Date : {{ Carbon\Carbon::now()->day. '/'.  Carbon\Carbon::now()->month .'/'. Carbon\Carbon::now()->year .'  '. Carbon\Carbon::now()->hour. ':'.  Carbon\Carbon::now()->minute .':'. Carbon\Carbon::now()->second  }}</h5>
      </div>
    </div>
    <br><br>
    <table class="table">
      <thead>
        <th>Quantité</th>
        <th>Désignation</th>
        <th>Prix Unitaire</th>
        <th>Montant</th>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        @foreach($produits as $p)
          <tr>
            <td>{{$p->quantite}}</td>
            <td>{{$p->libelle}} ({{ $p->unite }})</td>
            <td>{{$p->prix_vente}}</td>
            <td>{{$p->montant}}</td>
          </tr>
          <?php $total += $p->montant; ?>
        @endforeach
        <tr>
          <td colspan="4" class="text-center">  <h2>Total HT : {{$total}} FCFA</h2> </td>
        </tr>
        <tr>
          <td colspan="4" class="text-center">  <h2>TVA : 0 FCFA</h2> </td>
        </tr>
        <tr>
          <td colspan="4" class="text-center">  <h2>Total TTC : {{$total}} FCFA</h2> </td>
        </tr>
      </tbody>
    </table>

  </body>
</html>
