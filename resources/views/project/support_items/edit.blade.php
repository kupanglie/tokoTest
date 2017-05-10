@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Items In</h5>
			</div>
			<div class="ibox-content">
				{{ Form::open(['route' => ['support-items.update', $support_item->id], 'method'=> 'PUT', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Support Item Name</label>
						<div class="col-lg-10">
							<input class="form-control" name="name" value="{{ $support_item->name }}"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Project Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="project_id">
								<option selected>-- Choose Project Name --</option>
								@foreach($projects as $project)
									<option value="{{ $project->id }}" {{ $project->id == $support_item->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Quantity</label>
						<div class="col-lg-10">
							<input type="Number" class="form-control" name="qty" value="{{ $support_item->qty }}"></input>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Price</label>
						<div class="col-lg-10">
							<input type="number" class="form-control" name="price" value="{{ $support_item->price }}"></input>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-6 col-lg-4">
							<button class="btn btn-primary" type="submit">Submit</button>
							<button class="btn btn-white" type="submit" onclick="btnCancel()">Cancel</button>
						</div>
					</div>
				{{ Form::close() }}
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
