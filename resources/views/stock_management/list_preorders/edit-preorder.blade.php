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
				{{ Form::open(['route' => ['update-preorder'], 'method'=> 'POST', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="preorder_id" value="{{ $preorder->id }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">No Preorder</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="no_preorder" value="{{ $preorder->no_preorder }}" readonly>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="supplier_mapping_id" value="{{ $preorder_supplier->supplier_mapping_id }}">
						<label class="col-lg-2 control-label">Supplier Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="supplier_id">
								<option disabled selected>-- Choose Supplier Name --</option>
								@foreach($suppliers as $supplier)
									<option value="{{ $supplier->id }}" {{ $supplier->id == $preorder_supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" name="expedition_mapping_id" value="{{ $preorder_expedition->expedition_mapping_id }}">
						<label class="col-lg-2 control-label">Expedition Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="expedition_id">
								<option disabled selected>-- Choose Expedition Name --</option>
								@foreach($expeditions as $expedition)
									<option value="{{ $expedition->id }}" {{ $expedition->id == $preorder_expedition->id ? 'selected' : '' }}>{{ $expedition->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addmore btn btn-primary'>+ Add Item</button>
						</div>
					</div>

					<div class="visble">
						@foreach($preorder_items as $number => $preorder_item )
							<div class="item_row{{ $number+1 }}" style="margin: 50px 0px 50px 0px;">
								<input type="hidden" name="preorder_item_mapping_id[]" value="{{ $preorder_item->id }}">
								<div class="form-group">
									<label class="col-lg-1 control-label" onclick="deleterow({{ $number+1 }})">
										<span class="fa fa-trash" style="font-size:24px"></span>
									</label>
									<label class="col-lg-1 control-label">Item Name</label>
									<div class="col-lg-10">
										<select class="form-control" name="item_id[]">
											<option disabled selected>-- Choose Item Name --</option>
											@foreach($items as $item)
												<option value="{{ $item->id }}"  {{ $item->id == $preorder_item->item_id ? 'selected' : '' }}>{{ $item->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Quantity</label>
									<div class="col-lg-10">
										<input type="Number" class="form-control" name="qty[]" value="{{ $preorder_item->qty }}">
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Length</label>
									<div class="col-lg-10">
										<input type="Number" class="form-control" name="length[]" value="{{ $preorder_item->length }}">
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<input type="hidden" name="row_count" id="row_count" value="{{ count($preorder_items) }}">
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

$(".addmore").on('click',function(){
	var row_cntr = $("#row_count").val();
	row_cntr = parseInt(row_cntr) + 1;
	var data = '<div class="item_row'+row_cntr+'">'+
	'<div class="form-group">'+
	'<label class="col-lg-1 control-label" onclick="deleterow('+row_cntr+')">'+
	'<span class="fa fa-trash" style="font-size:24px"></span>'+
	'</label>'+
	'<label class="col-lg-1 control-label">Item Name</label>'+
	'<div class="col-lg-10">'+
	'<select class="form-control" name="item_id[]">'+
	'<option disabled selected>-- Choose Item Name --</option>'+
	'@foreach($items as $item)'+
	'<option value="{{ $item->id }}">{{ $item->name }}</option>'+
	'@endforeach'+
	'</select>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Quantity</label>'+
	'<div class="col-lg-10">'+
	'<input type="Number" class="form-control" name="qty[]">'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Length</label>'+
	'<div class="col-lg-10">'+
	'<input type="Number" step="any" class="form-control" name="length[]">'+
	'</div>'+
	'</div>';
	$('.visble').append(data);
	$("#row_count").val(row_cntr);
});

function deleterow(ar)
{
	var ttt = ar;
	$(".item_row"+ttt+"").remove(".item_row"+ttt+"");
	var i=Number($('#row_count').val());
	i=i-1;
	$('#row_count').val(i);
}
</script>
@endsection
