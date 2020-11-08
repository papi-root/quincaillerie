@extends('layouts.dashboard')

@section('content')
<!-- /.content-header -->
<section class="content">
<div class="container-fluid">

<div class="card card-default">
<div class="card-header text-center">
  <h4 class="text-center" style="background: #1D62F0; color: #fff; padding: 10px;">TOTAL PAR JOUR</h4>
</div>
<div class="row">
    <div class="col-md-4 col-sm-3">
    <a href="{{ route('total.caissier')}}"
          class="show-modal-add btn btn-sm btn-primary" style="margin-left: 5%; box-shadow: 0px 0px 15px #95A5A6; background: #1D62F0; color: #fff;"><i class="fa fa-plus"></i>PAR CAISSIER(E)</a>
    </div>
</div>
<br>
<div class="card-body">
  <table id="datatable" class="table table-striped">
    <thead>
      <th>Date</th>
      <th>Total</th>

    </thead>
    <tbody id="tbody">

      @foreach($total as $t)
        <tr>
          <td>{{Carbon\Carbon::parse($t->jour)->day. '-'.  Carbon\Carbon::parse($t->jour)->month .'-'. Carbon\Carbon::parse($t->jour)->year}}</td>
          <td>{{ $t->total }}</td>
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
