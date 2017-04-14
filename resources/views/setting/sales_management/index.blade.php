@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h2>List Sales</h2>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th>Name</th>
							<th>Identity Number</th>
							<th>Address</th>
							<th>Handphone Number</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sales_list as $sales)
							<tr>
								<td>{{ $sales->name }}</td>
								<td>{{ $sales->identity_number }}</td>
								<td>{{ $sales->address }}</td>
								<td>{{ $sales->handphone_number }}</td>
								<td style="width:10%">
									<div class="col col-lg-1" style="padding-left:0">
										<a href="{{ route('sales-management.edit', $sales->id) }}">
											<span class="fa fa-pencil-square" style="font-size:20px"></span>
										</a>
									</div>
									<div class="col col-lg-1">
										{{ Form::open(['id' => 'deleteSales'.$sales->id, 'route' => ['sales-management.destroy', $sales->id], 'method' => 'DELETE']) }}
											<a href="#" onclick="document.getElementById('deleteSales{{$sales->id}}').submit();">
												<span class="fa fa-trash" style="font-size:20px"></span>
											</a>
										{{ Form::close() }}
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a href="{{ route('sales-management.create') }}"><button type="button" class="btn btn-primary">Add Sales</button></a>
							</td>
							<td colspan="4">
								<ul class="pagination pull-right"></ul>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function() {
	$('.footable').footable();
});
</script>
@endsection
