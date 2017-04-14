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
				{{ Form::open(['route' => ['items-in.store'], 'method'=> 'POST', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Item Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="item_id">
								<option disabled selected>-- Choose Item Name --</option>
								@foreach($items as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Project Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="project_id">
								<option selected>-- Choose Project Name --</option>
								@foreach($projects as $project)
									<option value="{{ $project->id }}">{{ $project->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Length Category</label>
						<div class="col-lg-10">
							<select class="form-control" name="length_id">
								<option disabled selected>-- Choose Length Category --</option>
								@foreach($length_categories as $length_category)
									<option value="{{ $length_category->id }}">{{ $length_category->upper_length }}m - {{ $length_category->lower_length }}m</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Length</label>
						<div class="col-lg-10">
							<div class="input-group">
								<input type="Number" step="any" class="form-control" name="length"><span class="input-group-addon" id="length">m</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Thick Category</label>
						<div class="col-lg-10">
							<select class="form-control" name="thick_id">
								<option disabled selected>-- Choose Thick Category --</option>
								@foreach($thick_categories as $thick_category)
									<option value="{{ $thick_category->id }}">{{ $thick_category->thick }}cm</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Quantity</label>
						<div class="col-lg-10">
							<div class="input-group">
								<input type="Number" class="form-control" name="qty"><span class="input-group-addon" id="qty">lembar</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Information</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" name="information"></textarea>
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
