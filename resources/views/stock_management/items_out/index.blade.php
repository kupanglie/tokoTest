@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h2>List Items Out</h2>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th>Name</th>
							<th>Project</th>
							<th>Length Category</th>
							<th>Length</th>
							<th>Thick</th>
							<th>Quantity</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@foreach($itemsOut as $itemOut)
							<tr>
								<td>{{ $itemOut->name }}</td>
								<td>{{ $itemOut->project_name }}</td>
								<td>{{ $itemOut->upper_length }}m - {{ $itemOut->lower_length }}m</td>
								<td>{{ $itemOut->actual_length }}m</td>
								<td>{{ $itemOut->thick }}cm</td>
								<td>{{ $itemOut->qty }}</td>
								<td>{{ $itemOut->created_at }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a href="{{ route('items-out.create') }}">
									<button type="button" class="btn btn-primary">Add Outcome Item</button>
								</a>
							</td>
							<td colspan="6">
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
