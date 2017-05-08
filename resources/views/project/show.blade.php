@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h1>Detail Project</h1>
			</div>
			<div class="ibox-content">
				<div class="row m-t-sm">
					<div class="col-lg-12">
						<div class="panel blank-panel">
							<div class="panel-heading">
								<div class="panel-options">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab-1" data-toggle="tab">Works</a></li>
										<li class=""><a href="#tab-2" data-toggle="tab">Items In/Out</a></li>
										<li class=""><a href="#tab-3" data-toggle="tab">Profit Analize</a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<div class="tab-content">
									<div class="tab-pane active" id="tab-1">
										<div class="col col-md-6">
											<table class="table table-bordered">
												<h4>Total Estimated Work Quantity : {{ $total_estimated_work_qty }} m<sup>2</sup></h4>
												<h4>Total Estimated Work Quantity Run : {{ $total_estimated_work_qty_run }} m<sup>1</sup></h4>
												<thead>
													<tr>
														<th colspan="2">Estimated Works</th>
													</tr>
												</thead>
												<tbody>
													@foreach($estimated_works as $estimated_work)
													<tr>
														<td>{{ $estimated_work->name }}</td>
														<td style="width:15%; text-align:center">
															@if(strpos($estimated_work->name, 'drop celling') !== false)
																{{ $estimated_work->qty }} m<sup>1</sup>
															@else
																{{ $estimated_work->qty }} m<sup>2</sup>
															@endif	
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="col col-md-6">
											<table class="table table-bordered">
												<h4>Total Real Work Quantity : {{ $total_real_work_qty }} m<sup>2</sup></h4>
												<h4>Total Real Work Quantity Run : {{ $total_real_work_qty_run }} m<sup>1</sup></h4>
												<thead>
													<tr>
														<th colspan="2">Real Works</th>
													</tr>
												</thead>
												<tbody>
													@foreach($real_works as $real_work)
													<tr>
														<td>{{ $real_work->name }}</td>
														<td style="width:15%; text-align:center">
															@if(strpos($real_work->name, 'drop celling') !== false)
																{{ $real_work->qty }} m<sup>1</sup>
															@else
																{{ $real_work->qty }} m<sup>2</sup>
															@endif	
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="tab-2">
										<div class="col col-md-12">
											<h4>Total Items Used : {{ $total_items_used }} m<sup>2</sup></h4>
										</div>
										<div class="col col-md-6">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th colspan="2">Items Out</th>
													</tr>
												</thead>
												<tbody>
													@foreach($items_out as $item_out)
													<tr>
														<td>{{ $item_out->name }}</td>
														@if($item_out->actual_length != NULL)
															<td style="width:15%; text-align:center">{{ $item_out->item_out_qty * $item_out->actual_length * 0.2 }} m<sup>2</sup></td>
														@else
															<td style="width:15%; text-align:center">{{ $item_out->item_out_qty }} buah</td>
														@endif
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
										<div class="col col-md-6">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th colspan="2">Items Return</th>
													</tr>
												</thead>
												<tbody>
													@foreach($items_in as $item_in)
													<tr>
														<td>{{ $item_in->name }}</td>
														<td style="width:15%; text-align:center">{{ $item_in->item_in_qty * $item_in->actual_length * 0.2 }} m<sup>2</sup></td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="tab-3">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>No</th>
													<th>Information</th>
													<th>Qty</th>
													<th>Price</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td style="width:10px; text-align:center;">
														1
													</td>
													<td colspan="4">
														Items
													</td>
												</tr>
												@foreach($items_used as $item_used)
												<tr>
													<td></td>
													<td>{{ $item_used->name }}</td>
													<td>
														@if(substr($item_used->name, 0, 3) == 'UP-' || substr($item_used->name, 0, 3) == 'LU-' || substr($item_used->name, 0, 3) == 'LK-' || substr($item_used->name, 0, 3) == 'LH-' || substr($item_used->name, 0, 3) == 'LJ-')
															{{ $item_used->item_qty * 5.8 }}
														@else
															{{ $item_used->item_qty }}
														@endif
														meter
													</td>
													<td>Rp {{ $item_used->buy_price }}</td>
													<td>
														@if(substr($item_used->name, 0, 3) == 'UP-' || substr($item_used->name, 0, 3) == 'LU-' || substr($item_used->name, 0, 3) == 'LK-' || substr($item_used->name, 0, 3) == 'LH-' || substr($item_used->name, 0, 3) == 'LJ-')
															Rp {{ ($item_used->item_qty * 5.8) * ($item_used->buy_price/5.8) }}
														@else
															Rp {{ $item_used->item_qty * $item_used->buy_price }}
														@endif
													</td>
												</tr>
												@endforeach
												<tr>
													<td style="width:10px; text-align:center;">
														2
													</td>
													<td colspan="4">
														Work Cost
													</td>
												</tr>
												@foreach($real_works as $real_work)
													<tr>
														<td></td>
														<td>{{ $real_work->name }}</td>
														<td>
															{{ $real_work->qty }}
															m<sup>2</sup>
														</td>
														<td>Rp {{ $real_work->price }}</td>
														<td>
															Rp {{ $real_work->qty * $real_work->price }}
														</td>
													</tr>
												@endforeach
												<tr class="support_items">
													<td style="width:10px; text-align:center;">
														3
													</td>
													<td colspan="5">
														Support Item
													</td>
												</tr>
												<tr>
													<td></td>
													<td colspan="4">
														<a href="#">
															<div class="addSupportItem">
																<span class="fa fa-plus"></span> Add Support Items
															</div>
														</a>
													</td>
												</tr>
												<input type="hidden" name="row_count_support" id="row_count_support" value="0">
												<tr class="extra_cost">
													<td style="width:10px; text-align:center;">
														4
													</td>
													<td colspan="5">
														Extra Cost
													</td>
												</tr>
												<tr>
													<td></td>
													<td colspan="4">
														<a href="#">
															<div class="addExtraCost">
																<span class="fa fa-plus"></span> Add Extra Items
															</div>
														</a>
													</td>
												</tr>
												<input type="hidden" name="row_count_extra" id="row_count_extra" value="0">
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@if($project->status_id == 4)
				<div class="ibox-footer">
					<div class="row">
						<div class="col-lg-offset-5 col-lg-4">
							<button class="btn btn-primary" type="submit">Opname Now</button>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script>
	function countTotalSupportPrice(id) {
		var totalPrice = $('#support_qty'+id).val() * $('#support_price'+id).val();
		$('#support_total_price'+id).text('Rp '+totalPrice);
	}

	function countTotalExtraPrice(id) {
		var totalPrice = $('#extra_qty'+id).val() * $('#extra_price'+id).val();
		$('#extra_total_price'+id).text('Rp '+totalPrice);
	}

	$(".addSupportItem").on('click',function(){
		var row_cntr_support = $("#row_count_support").val();
		row_cntr_support = parseInt(row_cntr_support) + 1;
		var data = 
		'<tr class="item_estimated_row'+row_cntr_support+'">'+
		'<td></td>'+
		'<td colspan="4">'+
		'{{ Form::open(["route" => ["update-support-item"], "method"=> "POST", "enctype"=> "multipart/form-data"]) }}'+
		'<div class="col-md-2">'+
		'<input type="text" placeholder="Support Item Name" name="support_item_name"></input>'+
		'</div>'+
		'<div class="col-md-2">'+
		'<input type="number" id="support_qty'+row_cntr_support+'" placeholder="Total Item" name="support_item_qty"></input>'+
		'</div>'+
		'<div class="col-md-2">'+
		'<input type="number" id="support_price'+row_cntr_support+'" placeholder="Item Price" name="support_item_price" onchange="countTotalSupportPrice('+row_cntr_support+')"></input>'+
		'</div>'+
		'<div class="col-md-3" id="support_total_price'+row_cntr_support+'">'+
		'</div>'+
		'<div class="col-md-3 pull-right">'+
		'<button type="submit">Submit</button>'+
		'</div>'+
		'{{ Form::close() }}'+
		'</td>'+
		'</tr>';
		$('.support_items').after(data);
		$("#row_count_support").val(row_cntr_support);
	});

	function deleteRowEstimated(ar)
	{
		var ttt = ar;
		$(".item_estimated_row"+ttt+"").remove(".item_estimated_row"+ttt+"");
		var i=Number($('#row_count_estimated').val());
		i=i-1;
		$('#row_count_estimated').val(i);
	}

	$(".addExtraCost").on('click',function(){
		var row_cntr_extra = $("#row_count_extra").val();
		row_cntr_extra = parseInt(row_cntr_extra) + 1;
		var data = 
		'<tr class="item_estimated_row'+row_cntr_extra+'">'+
		'<td></td>'+
		'<td>'+
		'<input type="text" placeholder="Extra Cost Name" name="extra_cost_name[]"></input>'+
		'</td>'+
		'<td>'+
		'<input type="number" id="extra_qty'+row_cntr_extra+'" placeholder="Total Item" name="extra_cost_qty[]"></input>'+
		'</td>'+
		'<td>'+
		'<input type="number" id="extra_price'+row_cntr_extra+'" placeholder="Item Price" name="extra_cost_price[]" onchange="countTotalExtraPrice('+row_cntr_extra+')"></input>'+
		'</td>'+
		'<td>'+
		'<div class="col col-md-6" id="extra_total_price'+row_cntr_extra+'">'+
		'</div>'+
		'<div class="col col-md-6 pull-right">'+
		// '<button type="submit">Submit</button>'+
		'</div>'+
		'</td>'+
		'</tr>';
		$('.extra_cost').after(data);
		$("#row_count_extra").val(row_cntr_extra);
	});

	function deleteRowEstimated(ar)
	{
		var ttt = ar;
		$(".item_estimated_row"+ttt+"").remove(".item_estimated_row"+ttt+"");
		var i=Number($('#row_count_estimated').val());
		i=i-1;
		$('#row_count_estimated').val(i);
	}
</script>
@endsection()