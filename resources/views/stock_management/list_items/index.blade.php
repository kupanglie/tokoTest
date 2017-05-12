@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h2>List Items</h2>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				<table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
					<thead>
						<tr>
							<th>Name</th>
							<th>Length Category</th>
							<th>Length</th>
							<th>Thick</th>
							<th>Stock</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($item_mappings as $item_mapping)
							<tr>
								<td>{{ $item_mapping->name }}</td>
								<td>
									@if($item_mapping->upper_length != NULL)
										{{ $item_mapping->upper_length }}m - {{ $item_mapping->lower_length }}m
									@else
										-
									@endif
								</td>
								<td>
									@if($item_mapping->actual_length != NULL)
										{{ $item_mapping->actual_length }}m
									@else
										-
									@endif
								</td>
								<td>
									@if($item_mapping->thick != NULL)
										{{ $item_mapping->thick }}cm
									@else
										-
									@endif
								</td>
								<td>{{ $item_mapping->qty }}</td>
								<td id="tdPrice{{ $item_mapping->stock_id }}" style="width:20%">
									<div id="divPrice{{ $item_mapping->stock_id }}">
										@if($item_mapping->sell_price == NULL)
											<button type="button" class="btn btn-primary btn-xs" onclick="addPrice({{ $item_mapping->stock_id }})">Please Add Price</button>
										@else
											Rp {{ $item_mapping->sell_price }}
											<button type="button" class="btn btn-primary btn-xs"><span class="fa fa-pencil" onclick="updatePrice({{ $item_mapping->stock_id }})"></span></button>
										@endif
									</div>
								</td>
								<td style="width:15%">
									@if($item_mapping->is_opname == 0)
										<a href="{{ route('list-items.edit', $item_mapping->item_mapping_id) }}">
											<button type="button" class="btn btn-primary btn-xs">Opname Now</button>
										</a>
									@else
										Already Opname
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<td colspan="2">
								<a href="{{ route('opname-items') }}">
									<button type="button" class="btn btn-primary">Opname PDF</button>
								</a>
							</td>
							<td colspan="5">
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

function addPrice(id)
{
	var data = '{{ Form::open(["route" => ["update-item-price"], "method"=> "POST", "enctype"=> "multipart/form-data"]) }}'+
	'<input type="hidden" name="stock_id" style="max-width:100px" value="'+id+'">'+
	'<input type="Number" name="price" style="max-width:100px">'+
	'<button type="submit" style="width:60px; margin-left:10px">Submit</button>'+
	'{{ Form::close() }}';
	$('#divPrice'+id).remove();
	$('#tdPrice'+id).append(data);
}

function updatePrice(id)
{
	var data = '{{ Form::open(["route" => ["update-item-price"], "method"=> "POST", "enctype"=> "multipart/form-data"]) }}'+
	'<input type="hidden" name="stock_id" style="max-width:100px" value="'+id+'">'+
	'<input type="Number" name="price" style="max-width:100px" value="{{ $item_mapping->sell_price }}">'+
	'<button type="submit" style="width:60px; margin-left:10px">Submit</button>'+
	'{{ Form::close() }}';
	$('#divPrice'+id).remove();
	$('#tdPrice'+id).append(data);
}
</script>
@endsection
