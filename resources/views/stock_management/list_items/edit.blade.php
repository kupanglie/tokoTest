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
				{{ Form::open(['route' => ['list-items.update', $item_mapping->item_mapping_id], 'method'=> 'PUT', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Item Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="item_name" value="{{ $item_mapping->name }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Length</label>
						<div class="col-lg-10">
							<input type="Number" step="any" class="form-control" name="length" value="{{ $item_mapping->actual_length }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Thick</label>
						<div class="col-lg-10">
							<input type="text" name="thick" class="form-control" value="{{ $item_mapping->thick }}" readonly>
						</div>
					</div>
					<input type="hidden" name="stock_id" value="{{ $item_mapping->stock_id }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Quantity</label>
						<div class="col-lg-10">
							<input type="Number" class="form-control" name="qty" value="{{ $item_mapping->qty }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Actual Quantity</label>
						<div class="col-lg-10">
							<input type="Number" class="form-control" name="actual_qty">
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
