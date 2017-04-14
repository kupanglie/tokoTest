@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Horizontal form</h5>
			</div>
			<div class="ibox-content">
				{{ Form::open(['route' => ['suppliers-management.update', $supplier->id], 'method'=> 'PUT', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="name" value="{{ $supplier->name }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Handphone Number</label>
						<div class="col-lg-10">
							<input type="number" class="form-control" name="handphone_number" value="{{ $supplier->handphone_number }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Information</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" name="information">{{ $supplier->information }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-6 col-lg-4">
							<button class="btn btn-primary" type="submit">Submit</button>
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection
