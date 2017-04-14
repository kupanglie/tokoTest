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
				{{ Form::open(['route' => ['list-preorders.update', $preorder->id], 'method'=> 'PUT', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
							<input type="number" class="form-control" name="expedition_price">
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addmore btn btn-primary'>+ Add Item</button>
						</div>
					</div> -->
					@foreach($preorder_items as $preorder_item)
						<div class="item_row" style="margin: 50px 0px 50px 0px;">
							<input type="hidden" name="preorder_item_mapping_id[]" value="{{ $preorder_item->id }}">
							<div class="form-group">
								<label class="col-lg-2 control-label">Item Name</label>
								<div class="col-lg-10">
									<input type="hidden" name="item_id[]" value="{{ $preorder_item->item_id }}">
									<input type="text" class="form-control" name="name[]" value="{{ $preorder_item->item_name }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Quantity</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->qty }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Actual Quantity</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="actual_qty[]">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Length Category</label>
								<div class="col-lg-10">
									<select class="form-control" name="length_id[]">
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
									<input type="Number" step="any" class="form-control" value="{{ $preorder_item->length }}" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Actual Length</label>
								<div class="col-lg-10">
									<input type="Number" step="any" class="form-control" name="length[]">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Thick Category</label>
								<div class="col-lg-10">
									<select class="form-control" name="thick_id[]">
										<option disabled selected>-- Choose Thick Category --</option>
										@foreach($thick_categories as $thick_category)
											<option value="{{ $thick_category->id }}">{{ $thick_category->thick }}cm</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Item Price</label>
								<div class="col-lg-10">
									<input type="Number" class="form-control" name="price[]">
								</div>
							</div>
						</div>
					@endforeach
					<!-- <div class="visble"></div>
					<input type="hidden" name="row_count" id="row_count" value="0"> -->

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
