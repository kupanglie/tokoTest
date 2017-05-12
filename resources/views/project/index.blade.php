@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Simple FooTable with pagination, sorting and filter</h5>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>Status</th>
							<th>Start Work</th>
							<th>Remaining Payment</th>
							<th>Opname Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($projects as $project)
							<tr>
								<td>{{ $project->name }}</td>
								<td>{{ $project->category_desc }}</td>
								<td>{{ $project->status_desc }}</td>
								<td>{{ $project->start_working == NULL ? 'Not Yet Started' : $project->start_working }}</td>
								<td>{{ $project->payment_value == NULL ? 'Not Specified' : $project->payment_value }}</td>
								<td>{{ $project->opname_is == NULL ? 'Not Yet Opnamed' : 'Already Opnamed' }}</td>
								<td style="width:10%">
									<div class="col col-lg-1" style="padding-left:0">
										<a href="{{ route('projects.show', $project->project_id) }}">
											<button type="button" class="btn btn-primary btn-xs">View Project Detail</button>
										</a>
									@if($project->status_id == 2)
										<a href="{{ route('projects.edit', $project->project_id) }}">
											<button type="button" class="btn btn-primary btn-xs">Edit Project</button>
										</a>
									@elseif($project->status_id == 1)
										<a href="{{ route('projects.edit', $project->project_id) }}">
											<button type="button" class="btn btn-primary btn-xs">Edit Project</button>
										</a>
										<a href="{{ route('items-out.create') }}">
											<button type="button" class="btn btn-primary btn-xs">Add Items Out</button>
										</a>
										<a href="{{ route('items-in.create') }}">
											<button type="button" class="btn btn-primary btn-xs">Add Items Return</button>
										</a>
										<a href="{{ route('support-items.create') }}">
											<button type="button" class="btn btn-primary btn-xs">Add Support Items</button>
										</a>
										<a href="{{ route('extra-costs.create') }}">
											<button type="button" class="btn btn-primary btn-xs">Add Extra Cost</button>
										</a>
									@else
										<a href="{{ route('projects.edit', $project->project_id) }}">
											<button type="button" class="btn btn-primary btn-xs">Payment</button>
										</a>
									@endif
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td>
								<a href="{{ route('projects.create') }}"><button type="button" class="btn btn-primary">Add Project</button></a>
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
