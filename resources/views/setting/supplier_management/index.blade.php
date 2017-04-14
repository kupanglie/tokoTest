@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h2>List Suppliers</h2>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th>Name</th>
							<th>Handphone Number</th>
							<th>Information</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($suppliers as $supplier)
							<tr>
								<td>{{ $supplier->name }}</td>
								<td>{{ $supplier->handphone_number }}</td>
								<td>{{ $supplier->information }}</td>
								<td style="width:10%">
									<div class="col col-lg-1" style="padding-left:0">
										<a href="{{ route('suppliers-management.edit', $supplier->id) }}">
											<span class="fa fa-pencil-square" style="font-size:20px"></span>
										</a>
									</div>
									<div class="col col-lg-1">
										{{ Form::open(['id' => 'deleteSupplier'.$supplier->id, 'route' => ['suppliers-management.destroy', $supplier->id], 'method' => 'DELETE']) }}
											<a href="#" onclick="document.getElementById('deleteSupplier{{$supplier->id}}').submit();">
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
								<a href="{{ route('suppliers-management.create') }}"><button type="button" class="btn btn-primary">Add Supplier</button></a>
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
