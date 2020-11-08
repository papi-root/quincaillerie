@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">


<div class="row">
  <div class="card card-default col-md-4" style="margin:5%;">
    <div class="card-header text-center">
      TOTAL SALLE
    </div>
    <div class="card-body text-center">
      <h3>{{ $salle }} FCFA</h3>
    </div>
  </div>

  <div class="card card-default col-md-4" style="margin:5%;">
    <div class="card-header text-center">
      TOTAL BAR
    </div>
    <div class="card-body text-center">
      <h3>{{ $bar }} FCFA</h3>
    </div>
  </div>
</div>
</div>

</section>

  <script type="text/javascript">
    $('#datatable').dataTable();
  </script>

@endsection
