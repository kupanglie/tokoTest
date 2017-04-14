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
				{{ Form::open(['route' => ['projects.update', $project->id], 'method'=> 'PUT', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="name" value="{{ $project->name }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Address</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" name="address">{{ $project->address }}</textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Sales</label>
						<div class="col-lg-10">
							<select class="form-control" name="sales">
								<option disabled selected>-- Choose Sales Name --</option>
								@foreach($sales as $sales_each)
									<option value="{{ $sales_each->id }}" {{ $project->sales_id == $sales_each->id ? 'selected' : '' }}>{{ $sales_each->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Status</label>
						<div class="col-lg-10">
							<select class="form-control" name="status_project">
								<option disabled selected>-- Choose Project Status --</option>
								@foreach($status_projects as $status_project)
									<option value="{{ $status_project->id }}" {{ $project->status_id == $status_project->id ? 'selected' : '' }}>{{ $status_project->desc }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">End Negotiation</label>
						<div class="col-lg-10" id="end_nego">
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" class="form-control" name="end_negotiation" value="{{ $project->end_nego }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Work Plan</label>
						<div class="col-lg-10">
							<div class="input-group">
								<input type="text" class="form-control" name="work_plan" value="{{ $project->work_plan }}"><span class="input-group-addon" id="work_plan">days</sup></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Start Working</label>
						<div class="col-lg-10" id="start_work">
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" class="form-control" name="start_working" value="{{ $project->start_working }}">
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
						<label class="col-lg-2 control-label">End Working</label>
						<div class="col-lg-10" id="end_work">
							<div class="input-group date">
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								<input type="text" class="form-control" name="end_working">
							</div>
						</div>
					</div> -->

					<!-- estimated -->
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addMoreEstimated btn btn-primary'>+ Add Estimated Work</button>
						</div>
					</div>

					<div class="estimated">
						@foreach($estimated_work_mappings as $number => $estimated_work_mapping )
							<div class="item_estimated_row{{ $number+1 }}">
								<div class="form-group">
									<label class="col-lg-1 control-label" onclick="deleteRowEstimated({{ $number+1 }})">
										@if($project->status_id == 2)
											<span class="fa fa-trash" style="font-size:24px"></span>
										@endif
									</label>
									<label class="col-lg-1 control-label">Work Name</label>
									<div class="col-lg-10">
										<select class="form-control" name="estimated_work_id[]">
											<option disabled selected>-- Choose Work Name --</option>
											@foreach($works as $work)
												<option value="{{ $work->id }}" {{ $estimated_work_mapping->work_id == $work->id ? 'selected' : '' }}>{{ $work->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Quantity</label>
									<div class="col-lg-10">
										<div class="input-group">
											<input type="Number" step="any" class="form-control" name="estimated_qty[]" value="{{ $estimated_work_mapping->qty }}"><span class="input-group-addon" id="estimated_qty">m<sup>2</sup></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">Area Description</label>
									<div class="col-lg-10">
										<input type="text" step="any" class="form-control" name="estimated_area_desc[]" value="{{ $estimated_work_mapping->area_desc }}">
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<input type="hidden" name="row_count_estimated" id="row_count_estimated" value="{{ count($estimated_work_mappings) }}">

					<!-- real -->
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addMoreReal btn btn-primary'>+ Add Real Work</button>
						</div>
					</div>

					<div class="real">
						@foreach($work_mappings as $number => $work_mapping )
						<div class="item_real_row{{ $number+1 }}">
							<div class="form-group">
								<label class="col-lg-1 control-label" onclick="deleteRowReal({{ $number+1 }})">
									<span class="fa fa-trash" style="font-size:24px"></span>
								</label>
								<label class="col-lg-1 control-label">Work Name</label>
								<div class="col-lg-10">
									<select class="form-control" name="real_work_id[]">
										<option disabled selected>-- Choose Work Name --</option>
										@foreach($works as $work)
											<option value="{{ $work->id }}" {{ $work_mapping->work_id == $work->id ? 'selected' : '' }}>{{ $work->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Quantity</label>
								<div class="col-lg-10">
									<div class="input-group">
										<input type="Number" step="any" class="form-control" name="real_qty[]" value="{{ $work_mapping->qty }}"><span class="input-group-addon" id="real_qty">m<sup>2</sup></span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">Area Description</label>
								<div class="col-lg-10">
									<input type="text" step="any" class="form-control" name="real_area_desc[]" value="{{ $work_mapping->area_desc }}">
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<input type="hidden" name="row_count_real" id="row_count_real" value="{{ count($work_mappings) }}">

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
$(document).ready(function(){
	$('#end_nego .input-group.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true,
		format: 'yyyy-mm-dd'
	});

	$('#start_work .input-group.date').datepicker({
		todayBtn: "linked",
		keyboardNavigation: false,
		forceParse: false,
		calendarWeeks: true,
		autoclose: true,
		format: 'yyyy-mm-dd'
	});
});

$(".addMoreEstimated").on('click',function(){
	var row_cntr_estimated = $("#row_count_estimated").val();
	row_cntr_estimated = parseInt(row_cntr_estimated) + 1;
	var data_estimated = '<div class="item_estimated_row'+row_cntr_estimated+'">'+
	'<div class="form-group">'+
	'<label class="col-lg-1 control-label" onclick="deleteRowEstimated('+row_cntr_estimated+')">'+
	'<span class="fa fa-trash" style="font-size:24px"></span>'+
	'</label>'+
	'<label class="col-lg-1 control-label">Work Name</label>'+
	'<div class="col-lg-10">'+
	'<select class="form-control" name="estimated_work_id[]">'+
	'<option disabled selected>-- Choose Work Name --</option>'+
	'@foreach($works as $work)'+
	'<option value="{{ $work->id }}">{{ $work->name }}</option>'+
	'@endforeach'+
	'</select>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Quantity</label>'+
	'<div class="col-lg-10">'+
	'<div class="input-group">'+
	'<input type="Number" step="any" class="form-control" name="estimated_qty[]"><span class="input-group-addon" id="estimated_qty">m<sup>2</sup></span>'+
	'</div>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Area Description</label>'+
	'<div class="col-lg-10">'+
	'<input type="text" step="any" class="form-control" name="estimated_area_desc[]">'+
	'</div>'+
	'</div>';
	$('.estimated').append(data_estimated);
	$("#row_count_estimated").val(row_cntr_estimated);
});

$(".addMoreReal").on('click',function(){
	var row_cntr_real = $("#row_count_real").val();
	row_cntr_real = parseInt(row_cntr_real) + 1;
	var data_real = '<div class="item_real_row'+row_cntr_real+'">'+
	'<div class="form-group">'+
	'<label class="col-lg-1 control-label" onclick="deleteRowReal('+row_cntr_real+')">'+
	'<span class="fa fa-trash" style="font-size:24px"></span>'+
	'</label>'+
	'<label class="col-lg-1 control-label">Work Name</label>'+
	'<div class="col-lg-10">'+
	'<select class="form-control" name="real_work_id[]">'+
	'<option disabled selected>-- Choose Work Name --</option>'+
	'@foreach($works as $work)'+
	'<option value="{{ $work->id }}">{{ $work->name }}</option>'+
	'@endforeach'+
	'</select>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Quantity</label>'+
	'<div class="col-lg-10">'+
	'<div class="input-group">'+
	'<input type="Number" step="any" class="form-control" name="real_qty[]"><span class="input-group-addon" id="real_qty">m<sup>2</sup></span>'+
	'</div>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Area Description</label>'+
	'<div class="col-lg-10">'+
	'<input type="text" step="any" class="form-control" name="real_area_desc[]">'+
	'</div>'+
	'</div>';
	$('.real').append(data_real);
	$("#row_count_real").val(row_cntr_real);
});

function deleteRowEstimated(ar)
{
	var ttt = ar;
	$(".item_estimated_row"+ttt+"").remove(".item_estimated_row"+ttt+"");
	var i=Number($('#row_count_estimated').val());
	i=i-1;
	$('#row_count_estimated').val(i);
}

function deleteRowReal(ar)
{
	var ttt = ar;
	$(".item_real_row"+ttt+"").remove(".item_real_row"+ttt+"");
	var i=Number($('#row_count_real').val());
	i=i-1;
	$('#row_count_real').val(i);
}

function btnCancel()
{
	document.location.href = '/project';
}
</script>
@endsection
