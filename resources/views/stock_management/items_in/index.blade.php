@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h2>List Items In</h2>
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
							<th>Preorder Number</th>
						</tr>
					</thead>
					<tbody>
						@foreach($itemsIn as $itemIn)
							<tr>
								<td>{{ $itemIn->name }}</td>
								<td>{{ $itemIn->project_name }}</td>
								<td>{{ $itemIn->upper_length }}m - {{ $itemIn->lower_length }}m</td>
								<td>{{ $itemIn->actual_length }}m</td>
								<td>{{ $itemIn->thick }}cm</td>
								<td>{{ $itemIn->quantity }}</td>
								<td>{{ $itemIn->date }}</td>
								<td>{{ $itemIn->no_preorder }}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a href="{{ route('items-in.create') }}">
									<button type="button" class="btn btn-primary">Add Incoming Item</button>
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

function showDetail()
		{
			document.location.href = '/project/show';
		}
</script>
@endsection
