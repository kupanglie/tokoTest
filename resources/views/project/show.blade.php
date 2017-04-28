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
													<th colspan="2">Qty</th>
													<th>Price</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td style="width:10px; text-align:center;">
														1
													</td>
													<td colspan="5">
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
													</td>
													<td>meter</td>
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
													<td colspan="5">
														Work Cost
													</td>
												</tr>
												@foreach($real_works as $real_work)
													<tr>
														<td></td>
														<td>{{ $real_work->name }}</td>
														<td>
															{{ $real_work->qty }}
														</td>
														<td>m<sup>2</sup></td>
														<td>Rp {{ $real_work->price }}</td>
														<td>
															Rp {{ $real_work->qty * $real_work->price }}
														</td>
													</tr>
												@endforeach
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
