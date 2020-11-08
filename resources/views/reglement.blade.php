<!DOCTYPE html>
<html lang="en" dir="ltr">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      *
      {
        font-size: 50px;
        font-family: 'Raleway', sans-serif;
      }
      td
      {
        padding: 25px;
      }
      body
      {
        padding: 100px;
      }
    </style>
  </head>
  <body>
    <div class="row">
      <div class="col-md-5">
        <img src="{{asset('/uploads/images/logo1.png')}}" style="width: 200px;"alt="">
        <br>
        <div style="font-size: 20px;">Serveuse: {{ $serveuse }}</div>
        <br>
        <div style="font-size: 20px;">{{ $place }}</div>

      </div>
      <div class="col-md-6">
        <h4 style="float:right;">{{ Carbon\Carbon::now()->day. '/'.  Carbon\Carbon::now()->month .'/'. Carbon\Carbon::now()->year .'  '. Carbon\Carbon::now()->hour. ':'.  Carbon\Carbon::now()->minute .':'. Carbon\Carbon::now()->second  }}</h4>
      </div>
    </div>
    <table style="padding: 0px;" class="text-center table">

      <tbody style="font-size: 50px;">
        <?php $total = 0; ?>
        @foreach($produits as $p)
          <tr>
            <td>{{$p->quantite}}</td>
            <td>{{$p->libelle}}</td>
            <td>{{$p->montant}}</td>
          </tr>
          <?php $total += $p->montant; ?>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      <h3>MONTANT PAYE : {{$total}} FCFA</h3>
      <br>
      <h3>MONTANT DONNE : {{$m_donnee}} FCFA</h3>
      <br>
      <h3>MONNAIE : {{$monnaie}} FCFA</h3>
      <br>
      <h4>Toute l'équipe d'EL TORO vous remercie de votre visite !</h4>
    </div>
  </body>
</html>
