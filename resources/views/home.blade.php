<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SALE</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />


		<!-- Bootstrap core CSS     -->
		<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- Animation library for notifications   -->
		<link href="{{asset('css/animate.min.css')}}" rel="stylesheet"/>

		<!--  Light Bootstrap Table core CSS    -->
		<link href="{{asset('css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


		<!--  CSS for Demo Purpose, don't include it in your project     -->
		<link href="{{asset('css/demo.css')}}" rel="stylesheet" />


		<!--     Fonts and icons     -->
		<link href="{{asset('css/pe-icon-7-stroke.css')}}" rel="stylesheet" />


		<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">

		<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">

		<script src="{{asset('js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
										<div class="logo">
				                <a href="#" class="simple-text">
				                    <img src="{{asset('/uploads/images/fb.png')}}" style="width: 200px;"alt="">
				                </a>
				            </div>
                </div>
						    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav text-center">

                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->


                            <li><a href="{{ route('accueil.index') }}" class="btn btn-info text-info">Gestion</a></li>
														<li>
																<a href="{{ route('logout') }}" class="btn btn-danger text-danger"

																		onclick="event.preventDefault();
																						 document.getElementById('logout-form').submit();">
																		Deconnexion
																</a>

																<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																		{{ csrf_field() }}
																</form>
														</li>
                    </ul>
                </div>
            </div>
        </nav>

				<?php $produits = App\Produit::all(); $stocks = App\Stock::all(); $clients = App\Client::all(); ?>
				<section class="content-fluid">
				<div class="row" style="margin: 5px;">
				    <div class="card card-default  col-md-7" style="margin: 10px;">
				      <div class="card-header text-center">
				        <h4>ARTICLES</h4>
				      </div>
				    <div class="row">
				    <br>

				    <div class="card-body">
				      <table id="datatable" class="table">
				        <thead>
				          <th >Libelle</th>
				          <th>Prix(FCFA)</th>
									<th>Quantité</th>
				          <th>Action</th>
				        </thead>
				        <tbody id="tbody">
				          @if($produits->count() > 0)
				            @foreach($produits as $p)
										  @foreach($stocks as $s)
											 @if($s->id_produit == $p->id && $s->quantite > 0)
				                <tr class="@if($s->quantite < 8) bg-warning @endif @if($s->quantite < 4) bg-danger @endif">
				                  <td> {{ $p->libelle }} </td>
				                  <td> {{ $p->prix_vente }} </td>
													<td> {{$s->quantite}} </td>
				                  <td>
				                  <form>

				                    <select class="form-control form-control-sm" id="{{$p->id}}">
				                      <?php
				                        $i = 1;
				                        while($i <= $s->quantite)
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

				    <div class="card card-default col-md-4" style="margin: 10px;">
				      <div class="card-body">

				        <table class="table table-striped">
				          <thead>
				            <th>client</th>
				            <th>telephone</th>
				            <th>Quantite</th>
				            <th>Montant</th>
				            <th>Action</th>
				          </thead>
				          <tbody id="tbody-panier">

				          </tbody>
				        </table>
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
						          <form method="post" action="{{ route('crediter.store') }}">
						              <input type="hidden" name="_token" value="{{ csrf_token() }}">
						              <div class="form-group">
						                <div class="row">
						                  <label class="col-md-3">Client: </label>
						                  <div class="col-md-6"><input type="text" name="client" class="form-control {{ $errors->has('client') ? 'is-invalid' : '' }}" value="{{ old('client')}}">
						                    @if($errors->has('client'))
						                    <div class="text-center text-danger">
						                      {{ $errors->first('client') }}
						                    </div>
						                    @endif
						                  </div>

						                  <div class="clearfix"></div>
						                </div>
						              </div>

						              <div class="form-group">
						                <div class="row">
						                  <label class="col-md-3">Téléphone: </label>
						                  <div class="col-md-6"><input type="text" name="telephone" class="form-control {{ $errors->has('telephone') ? ' is-invalid' : '' }}" value="{{ old('telephone')}}">
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

						<div id="showmodalDebiter" class="modal fade" role="dialog" tabindex="-1" >
						  <div class="modal-dialog" >
						      <div class="modal-content">
						          <div class="modal-header" style="background: #1D62F0;">
						            <button type="button" data-dismiss="modal" class="close" style="color: #fff; font-size: 30px;">&times;</button>
						            <h4 class="modal-title" style="text-align: center; color: #fff;"></h4>
						          </div>
						          <div class="modal-body">
						          <form method="post" action="{{ route('articleclient.store') }}">
						              <input type="hidden" name="_token" value="{{ csrf_token() }}">
						              <div class="form-group">
						                <div class="row">
										<label class="col-md-3">Client : </label>
									
										<div class="col-md-6">
											<select class="form-control {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client">
												<option value="">Veuillez choisir un client </option>
												@foreach($clients as $cl )
													<option value="{{ $cl->id }}">{{ $cl-> prenom. ' '. $cl->nom. ' '. $cl->telephone }} </option>
												@endforeach
											</select>
											@if($errors->has('client'))
												<div class="text-center text-danger">
												{{ $errors->first('client') }}
												</div>
											@endif

						                  <div class="clearfix"></div>
						                </div>
						              </div>
									  <br /> 
						              <div class="form-group  text-center">
						                <input type="submit" class="btn btn-primary" value="AJOUTER" style="background: #1D62F0; color: #fff; box-shadow: 0px 0px 15px #95A5A6;">
						              </div>
						            </form>

						          </div>
						      </div>
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

				  $('#datatable').dataTable();

					lister();

				  $.ajaxSetup({
				    headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				    }
				  });


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
				          rows = rows + "<td>"+ value.prix_vente + "</td>";
				          rows = rows + "<td>"+ value.quantite + "</td>";
				          rows = rows + "<td>"+ value.montant+ "</td>";
				          rows = rows + "<td><button class='btn btn-danger' onclick='supprimer("+ value.id +")'>Annuler</button></td>";
				          rows = rows + "</td></tr>";
				          total = total + value.montant;
				        });

				        if(total != 0)
				        {
				          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><h4> TOTAL : "+total+" FCFA</h4></td></tr>";
				          rows = rows + "<tr class='text-center bg-white'><td colspan='5'><a  href={{ route('confirmer.facture') }} target='_blank' onclick='redirect();' class='btn btn-success text-center'>Facturer</a> <a class='show-modal-add btn-primary btn btn-primary text-center'>Créditer</a></td></tr>";
						
						}

				        $('#tbody-panier').html(rows);
				      }
				    });

				  }

					function redirect()
					{
							window.location.reload();
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

					$(document).on('click', '.show-modal-add', function() {
					  $('#showmodalAdd').modal('show');
					  $('.modal-title').text('Ajouter une Entrée');
					  $('.modal-header').css('background', '#1D62F0');
					});

					$(document).on('click', '.show-modal-debiter', function() {
					  $('#showmodalDebiter').modal('show');
					  $('.modal-title').text('Choix du clients');
					  $('.modal-header').css('background', '#1D62F0');
					});

				</script>
				<!--   Core JS Files   -->
		  <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>

			<!--  Charts Plugin -->
			<script src="{{asset('js/chartist.min.js')}}"></script>

		    <!--  Notifications Plugin    -->
		    <script src="{{asset('js/bootstrap-notify.js')}}"></script>

		    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
			<script src="{{asset('js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

			<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
			<script src="{{asset('js/demo.js')}}"></script>


		    <script src="{{ asset('js/toastr.min.js') }}"></script>

				<script type="text/javascript">
						 @if(Session::has('warning'))
								$(document).ready(function(){

										demo.initChartist();

										$.notify({
												icon: 'pe-7s-angle-down-circle',
												message: "{{Session::get('warning')}}"

										},{
												type: 'warning',
												timer: 4000
										});

								});
						@endif

						@if(Session::has('info'))
								$(document).ready(function(){

										demo.initChartist();

										$.notify({
												icon: 'pe-7s-info',
												message: "{{Session::get('info')}}"

										},{
												type: 'info',
												timer: 4000
										});

								});

						@endif
				</script>

    <!-- Scripts -->

		<!--   Core JS Files   -->
	<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
</body>
</html>
