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
				{{ Form::open(['route' => ['verify-invoice', $preorder->id], 'method'=> 'POST', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="preorder_id" value="{{ $preorder->id }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">No Preorder</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="no_preorder" value="{{ $preorder->no_preorder }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Supplier Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="supplier_id" value="{{ $preorder->supplier_name }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Expedition Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="expedition_id" value="{{ $preorder->expedition_name }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Expedition Price</label>
						<div class="col-lg-10">
							<input type="number" class="form-control" name="expedition_price" value="{{ $preorder->price }}" readonly>
						</div>
					</div>
					@foreach($preorder_items as $preorder_item)
						<div class="item_row" style="margin: 50px 0px 50px 0px">
							<input type="hidden" name="preorder_item_mapping_id[]" value="{{ $preorder_item->id }}">
							<div class="form-group">
								<label class="col-lg-2 control-label">Item Name</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name="name[]" value="{{ $preorder_item->item_name }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Preorder Length</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->length }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Invoice Length</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->actual_length }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Preorder Quantity</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->qty }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Invoice Quantity</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->actual_qty }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Item Price</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="price[]" value="{{ $preorder_item->price }}" readonly>
								</div>
							</div>
						</div>
					@endforeach
					@if($preorder->verify_status != 1)
						<div class="col col-md-offset-6">
							<button type="submit" class="btn btn-primary">Verify Invoice</button>
						</div>
					@endif
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
