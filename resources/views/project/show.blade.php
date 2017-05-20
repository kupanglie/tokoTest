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
										@if($project->status_id == 4)
											@if($project->opname_is == 1)
												<li class=""><a href="#tab-4" data-toggle="tab">Payments</a></li>
											@endif
										@endif		
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
										<?php 
											$total_cost = 0;
											$total_income = 0;
											$omset_sales = 0;
											$profit = 0;
										?>
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
													<td>Rp {{ number_format($item_used->buy_price,0,',','.') }}</td>
													<td>
														@if(substr($item_used->name, 0, 3) == 'UP-' || substr($item_used->name, 0, 3) == 'LU-' || substr($item_used->name, 0, 3) == 'LK-' || substr($item_used->name, 0, 3) == 'LH-' || substr($item_used->name, 0, 3) == 'LJ-')
															Rp {{ number_format(($item_used->item_qty * 5.8) * ($item_used->buy_price/5.8),0,',','.') }}
															<?php $total_cost = $total_cost + ($item_used->item_qty * 5.8) * ($item_used->buy_price/5.8) ?>
														@else
															Rp {{ number_format(($item_used->item_qty * $item_used->buy_price),2,',','.') }}
															<?php $total_cost = $total_cost + $item_used->item_qty * $item_used->buy_price ?>
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
														<td>Rp {{ number_format($real_work->worker_cost,0,',','.') }}</td>
														<td>
															Rp {{ number_format($real_work->qty * $real_work->worker_cost,0,',','.') }}
															<?php 
																$total_cost = $total_cost + $real_work->qty * $real_work->worker_cost;
																$total_income = $total_income + $real_work->qty * $real_work->price
															 ?>
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
												@foreach($support_items as $support_item)
													<tr>
														<td>
															<a href="{{ route('support-items.edit', $support_item->id) }}">
																<span class="fa fa-pencil"></span>
															</a>
														</td>
														<td>{{ $support_item->name }}</td>
														<td>
															{{ $support_item->qty }}
														</td>
														<td>Rp {{ number_format($support_item->price,0,',','.') }}</td>
														<td>
															Rp {{ number_format($support_item->qty * $support_item->price,0,',','.') }}
															<?php $total_cost = $total_cost + $support_item->qty * $support_item->price ?>
														</td>
													</tr>
												@endforeach
												<tr class="extra_cost">
													<td style="width:10px; text-align:center;">
														4
													</td>
													<td colspan="5">
														Extra Cost
													</td>
												</tr>
												@foreach($extra_costs as $extra_cost)
													<tr>
														<td>
															<a href="{{ route('extra-costs.edit', $support_item->id) }}">
																<span class="fa fa-pencil"></span>
															</a>
														</td>
														<td>{{ $extra_cost->name }}</td>
														<td>
															1
														</td>
														<td>Rp {{ number_format($extra_cost->price,0,',','.') }}</td>
														<td>
															Rp {{ number_format(1 * $extra_cost->price,0,',','.') }}
															<?php $total_cost = $total_cost + 1 * $extra_cost->price ?>
														</td>
													</tr>
												@endforeach
												<tr>
													<td colspan="4" style="text-align: right">Total Cost</td>
													<td id="total_cost">Rp {{ number_format($total_cost,0,',','.') }}</td>
												</tr>
												<tr>
													<td colspan="4" style="text-align: right">Omset Sales</td>
													<?php 
														$omset_sales = $total_income * 3 / 100;
													?>
													<td id="total_cost">Rp {{ number_format($omset_sales,0,',','.') }}</td>
												</tr>
												<tr>
													<td colspan="4" style="text-align: right">Total Income</td>
													<td id="total_cost">Rp {{ number_format($total_income,0,',','.') }}</td>
												</tr>
												<tr>
													<td colspan="4" style="text-align: right">Profit</td>
													<?php 
														$profit = $total_income / ($total_cost + $omset_sales) * 100;
													?>
													<td id="total_cost">{{ round($profit) }} %</td>
												</tr>
											</tbody>
										</table>
									</div>
									@if($project->status_id == 4)
										@if($project->opname_is == 1)
											<div class="tab-pane" id="tab-4">
												<?php $amount_payed = 0 ?>
												@foreach($payments as $payment)
													<?php 
														$amount_payed = $amount_payed + $payment->payment_value; 
													?>
												@endforeach
												<h3>Payment Remaining : Rp {{ number_format($project->payment_value - $amount_payed,0,',','.') }}</h3>
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Date</th>
															<th>Payment Amount</th>
															<th>Payer</th>
															<th>Reciever</th>
														</tr>
													</thead>
													<tbody>
														@foreach($payments as $payment)
															<tr>
																<td>
																	{{ date('d M Y', strtotime($payment->updated_at)) }}
																</td>
																<td>Rp {{ number_format($payment->payment_value,0,',','.') }}</td>
																<td>{{ $payment->payer_name }}</td>
																<td>{{ $payment->reciever_name }}</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										@endif
									@endif	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@if($project->status_id == 4)
				@if($project->opname_is != 1)
					<div class="ibox-footer">
						<div class="row">
							<div class="col-lg-offset-5 col-lg-4">
								{{ Form::open(['route' => ['opname-project', $project->id], 'method'=> 'POST', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
									<input type="hidden" name="project_id" value="{{ $project->id }}"></input>
									<input type="hidden" name="payment_value" value="{{ $total_income }}"></input>
									<input type="hidden" name="cost_value" value="{{ $total_cost + $omset_sales }}"></input>
									<input type="hidden" name="profit" value="{{ $total_income - $total_cost - $omset_sales }}"></input>
									<input type="hidden" name="omset_sales" value="{{ $omset_sales }}"></input>
									<button class="btn btn-primary" type="submit">Opname Now</button>
								{{ Form::close() }}
							</div>
						</div>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>
@endsection