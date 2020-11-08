@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/chartist.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/Chart.min.css') }}">
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/Chart.extension.js') }}"></script>
  <script src="{{ asset('js/chartist.min.js') }}"></script>

<div class="row">
  <br>
      <div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1">
          <div class="card-default">
              <div class="card-body" style="background: #16a085; border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                  <div class="" style="font-size: 20px; padding: 16px; color:  rgb(215, 218, 219, 0.8);">
                      {{ $nbreUser }} Utilisateur(s)
                      <i class="pe-7s-user" style="font-size: 80px;"></i>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-3 col-sm-3 ">
          <div class="card-default">
              <div class="card-body" style="background: #c0392b; border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                  <div class="" style="font-size: 20px; padding: 30px; color:  rgb(215, 218, 219, 0.8);">
                     Crédits : {{ $credit }} FCFA
                      <i class="pe-7s-angle-up-circle" style="font-size: 40px;"></i>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-3 col-sm-3 ">
          <div class="card-default">
              <div class="card-body" style="background: #2980b9; border-radius: 5px; box-shadow: 0px 0px 15px #BDC3C7;">
                  <div class="" style="font-size: 20px; padding: 30px; color:  rgb(215, 218, 219, 0.8);">
                      Ventes : {{ $ventes }} FCFA
                      <i class="pe-7s-angle-down-circle" style="font-size: 50px;"></i>
                  </div>
              </div>
          </div>
      </div>

  </div>

<br>

<div class="card bg-white" style="width: 100%;" >
  <canvas id="Ventes" width="10" height="8"></canvas>
</div>

    <script>
      // Initialize a Line chart in the container with the ID chart1
      var ctx = document.getElementById('Ventes').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Janvier', 'Février', 'Mars','Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
          datasets: [{
            label: 'Ventes',
            backgroundColor: 'rgb(103, 58, 183, 0.8)',
            data: [
              @if(isset($tableau[1]))
                {{$tableau[1]}}
              @endif,
              @if(isset($tableau[2]))
                {{$tableau[2]}}
              @endif,
              @if(isset($tableau[3]))
                {{$tableau[3]}}
              @endif,
              @if(isset($tableau[4]))
                {{$tableau[4]}}
              @endif,
              @if(isset($tableau[5]))
                {{$tableau[5]}}
              @endif,
              @if(isset($tableau[6]))
                {{$tableau[6]}}
              @endif,
              @if(isset($tableau[7]))
                {{$tableau[7]}}
              @endif,
              @if(isset($tableau[8]))
                {{$tableau[8]}}
              @endif,
              @if(isset($tableau[9]))
                {{$tableau[9]}}
              @endif,
              @if(isset($tableau[10]))
                {{$tableau[10]}}
              @endif,
              @if(isset($tableau[11]))
                {{$tableau[11]}}
              @endif,
              @if(isset($tableau[12]))
                {{$tableau[12]}}
              @endif
            ]
          }]

      },

      options: {}
    });

    </script>

@endsection
