@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">TOTAL PAR CAISSIER(E)</h4>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>Date</th>
      <th>Total</th>
      <th>Caissier(e)</th>
    </thead>
    <tbody id="tbody">

      @foreach($total as $t)
        <tr>
          <td>{{Carbon\Carbon::parse($t->jour)->day. '-'.  Carbon\Carbon::parse($t->jour)->month .'-'. Carbon\Carbon::parse($t->jour)->year}}</td>
          <td>{{ $t->total }}</td>
          <td>{{ $t->prenom .' '. $t->nom }}</td>
        </tr>
      @endforeach
    </tbody>

  </table>
</div>
</div>

</div>
</section>

  <script type="text/javascript">
    $('#datatable').dataTable();
  </script>

@endsection
