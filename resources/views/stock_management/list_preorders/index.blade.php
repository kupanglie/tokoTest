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
				<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th data-toggle="true">No Preorder</th>
							<th>Supplier</th>
							<th>Expedition</th>
							<th>Request Date </th>
							<th>Arrive Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($preorders as $preorder)
							<tr>
								<td>{{ $preorder->no_preorder }}</td>
								<td>{{ $preorder->supplier_name }}</td>
								<td>{{ $preorder->expedition_name }}</td>
								<td>{{ $preorder->date_request }}</td>
								<td>
									@if($preorder->date_arrive != NULL)
										{{ $preorder->date_arrive }}
									@else
										Not arrive yet
									@endif
								</td>
								<td style="width:15%">
									<div class="col col-lg-6" style="padding-left:0">
										@if($preorder->date_arrive == NULL)
											<div class="row">
												<div class="col col-md-12">
													<a href="{{ route('edit-preorder', $preorder->id) }}">
														<button type="button" class="btn btn-primary btn-xs">Edit Preorder</button>
													</a>
												</div>
												<div class="col col-md-12">
													<a href="{{ route('preorder-invoice', $preorder->id) }}">
														<button type="button" class="btn btn-primary btn-xs">Print Preorder</button>
													</a>
												</div>
												<div class="col col-md-12">
													<a href="{{ route('list-preorders.edit', $preorder->id) }}">
														<button type="button" class="btn btn-primary btn-xs">Add Invoice</button>
													</a>
												</div>
											</div>
										@else
											<div class="col col-md-12">
												<a href="{{ route('list-preorders.show', $preorder->id) }}">
													<button type="button" class="btn btn-primary btn-xs">View</button>
												</a>
											</div>
											<div class="col col-md-12">
												<a href="{{ route('recap-invoice', $preorder->id) }}">
													<button type="button" class="btn btn-primary btn-xs">Print Recap</button>
												</a>
											</div>
										@endif
									</div>
									<!-- <div class="col col-lg-6">
										{{ Form::open(['id' => 'deletePreorder'.$preorder->id, 'route' => ['list-preorders.destroy', $preorder->id], 'method' => 'DELETE']) }}
											<a href="#" onclick="document.getElementById('deletePreorder{{$preorder->id}}').submit();">
												<span class="fa fa-trash" style="font-size:20px"></span>
											</a>
										{{ Form::close() }}
									</div> -->
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a href="{{ route('list-preorders.create') }}">
									<button type="button" class="btn btn-primary">Add Preorder</button>
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
@endsection
