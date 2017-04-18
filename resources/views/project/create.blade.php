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
				{{ Form::open(['route' => ['projects.store'], 'method'=> 'POST', 'enctype'=> 'multipart/form-data', 'class'=>'form-horizontal']) }}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Name</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Address</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" name="address"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Sales</label>
						<div class="col-lg-10">
							<select class="form-control" name="sales">
								<option disabled selected>-- Choose Sales Name --</option>
								@foreach($sales as $sales_each)
									<option value="{{ $sales_each->id }}">{{ $sales_each->name }}</option>
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
									<option value="{{ $status_project->id }}">{{ $status_project->desc }}</option>
								@endforeach
							</select>
						</div>
					</div>

					<!-- estimated -->
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addMoreEstimated btn btn-primary'>+ Add Estimated Work</button>
						</div>
					</div>

					<div class="estimated"></div>
					<input type="hidden" name="row_count_estimated" id="row_count_estimated" value="0">

					<!-- real -->
					<!-- <div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button type="button" class='addMoreReal btn btn-primary'>+ Add Real Work</button>
						</div>
					</div>

					<div class="real"></div>
					<input type="hidden" name="row_count_real" id="row_count_real" value="0"> -->

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
$(".addMoreEstimated").on('click',function(){
	var row_cntr_estimated = $("#row_count_estimated").val();
	row_cntr_estimated = parseInt(row_cntr_estimated) + 1;
	var data = '<div class="item_estimated_row'+row_cntr_estimated+'">'+
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
	'<input type="Number" step="any" class="form-control" name="estimated_qty[]"><span class="input-group-addon" id="estimated_qty">m<sup>2</sup> or m<sup>1</sup></span>'+
	'</div>'+
	'</div>'+
	'</div>'+
	'<div class="form-group">'+
	'<label class="col-lg-2 control-label">Area Description</label>'+
	'<div class="col-lg-10">'+
	'<input type="text" step="any" class="form-control" name="area_desc[]">'+
	'</div>'+
	'</div>';
	$('.estimated').append(data);
	$("#row_count_estimated").val(row_cntr_estimated);
});

// $(".addMoreReal").on('click',function(){
// 	var row_cntr_real = $("#row_count_real").val();
// 	row_cntr_real = parseInt(row_cntr_real) + 1;
// 	var data = '<div class="item_real_row'+row_cntr_real+'">'+
// 	'<div class="form-group">'+
// 	'<label class="col-lg-1 control-label" onclick="deleteRowReal('+row_cntr_real+')">'+
// 	'<span class="fa fa-trash" style="font-size:24px"></span>'+
// 	'</label>'+
// 	'<label class="col-lg-1 control-label">Item Name</label>'+
// 	'<div class="col-lg-10">'+
// 	'<select class="form-control" name="item_id[]">'+
// 	'<option disabled selected>-- Choose Item Name --</option>'+
// 	'@foreach($works as $work)'+
// 	'<option value="{{ $work->id }}">{{ $work->name }}</option>'+
// 	'@endforeach'+
// 	'</select>'+
// 	'</div>'+
// 	'</div>'+
// 	'<div class="form-group">'+
// 	'<label class="col-lg-2 control-label">Quantity</label>'+
// 	'<div class="col-lg-10">'+
// 	'<input type="Number" class="form-control" name="qty[]">'+
// 	'</div>'+
// 	'</div>'+
// 	'<div class="form-group">'+
// 	'<label class="col-lg-2 control-label">Length</label>'+
// 	'<div class="col-lg-10">'+
// 	'<input type="Number" step="any" class="form-control" name="length[]">'+
// 	'</div>'+
// 	'</div>';
// 	$('.real').append(data);
// 	$("#row_count_real").val(row_cntr_real);
// });

function deleteRowEstimated(ar)
{
	var ttt = ar;
	$(".item_estimated_row"+ttt+"").remove(".item_estimated_row"+ttt+"");
	var i=Number($('#row_count_estimated').val());
	i=i-1;
	$('#row_count_estimated').val(i);
}

// function deleteRowReal(ar)
// {
// 	var ttt = ar;
// 	$(".item_real_row"+ttt+"").remove(".item_real_row"+ttt+"");
// 	var i=Number($('#row_count_real').val());
// 	i=i-1;
// 	$('#row_count_real').val(i);
// }

function btnCancel()
{
	document.location.href = '/project';
}
</script>
@endsection
