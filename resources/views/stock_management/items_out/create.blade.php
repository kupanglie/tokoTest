@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="row">
	<div class="col col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Items Out</h5>
			</div>
			<div class="ibox-content">
				<form class="form-horizontal" action="{{ route('items-out.store') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-lg-2 control-label">Item Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="name" onchange="getLengthCategory()" id="item_id">
								<option disabled selected>-- Choose Item Name --</option>
								@foreach($items as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Project Name</label>
						<div class="col-lg-10">
							<select class="form-control" name="project_id">
								<option selected>-- Choose Project Name --</option>
								@foreach($projects as $project)
									<option value="{{ $project->id }}">{{ $project->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Length Category</label>
						<div class="col-lg-10">
							<select class="form-control" name="length_id" onchange="getActualLength()" id="lengthCategory">
								<option disabled selected>-- Choose Length Category --</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Length</label>
						<div class="col-lg-10">
							<select class="form-control" name="length" onchange="getThickCategory()" id="actualLength">
								<option disabled selected>-- Choose Length --</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Thick Category</label>
						<div class="col-lg-10">
							<select class="form-control" name="thick_id" onchange="getQuantity()" id="thickCategory">
								<option disabled selected>-- Choose Thick Category --</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Quantity</label>
						<div class="col-lg-10">
							<div class="input-group">
								<input type="Number" class="form-control" name="qty">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Information</label>
						<div class="col-lg-10">
							<textarea type="text" class="form-control" name="information"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-6 col-lg-4">
							<button class="btn btn-primary" type="submit">Submit</button>
							<button class="btn btn-white" type="submit" onclick="btnCancel()">Cancel</button>
						</div>
					</div>
				</form>
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

function clearLengthCategory() {
	$('#lengthCategory').html('');
	$('#lengthCategory').append($('<option>', {
		value: '',
		text : '-- Choose Length Category --'
	}));
	$('#lengthCategory option:nth-child(1)').prop('selected', true);
	$('#lengthCategory option:nth-child(1)').prop('disabled', true);
}

function clearActualLength() {
	$('#actualLength').html('');
	$('#actualLength').append($('<option>', {
		value: '',
		text : '-- Choose Length --'
	}));
	$('#actualLength option:nth-child(1)').prop('selected', true);
	$('#actualLength option:nth-child(1)').prop('disabled', true);
}

function clearThickCategory() {
	$('#thickCategory').html('');
	$('#thickCategory').append($('<option>', {
		value: '',
		text : '-- Choose Thick Category --'
	}));
	$('#thickCategory option:nth-child(1)').prop('selected', true);
	$('#thickCategory option:nth-child(1)').prop('disabled', true);
}

function clearItemQuantity() {
	$('#itemQuantity').remove();
}

function getLengthCategory() {
	clearLengthCategory();
	clearActualLength();
	clearThickCategory();
	clearItemQuantity();
	$.ajax({
		type: 'GET',
		url: "{{ url('getLengthCategory') }}",
		data: {
			'item_id': $('#item_id').val()
		}
	}).done(function(result) {
		$.each(result, function (i, item) {
			$('#lengthCategory').append($('<option>', {
				value: item.length_id,
				text : item.upper_length + 'm' + ' - ' + item.lower_length + 'm'
			}));
		});
	});
}

function getActualLength() {
	clearActualLength();
	clearThickCategory();
	clearItemQuantity();
	$.ajax({
		type: 'GET',
		url: "{{ url('getActualLength') }}",
		data: {
			'item_id': $('#item_id').val(),
			'length_id': $('#lengthCategory').val()
		}
	}).done(function(result) {
		$.each(result, function (i, item) {
			$('#actualLength').append($('<option>', {
				value: item.actual_length,
				text : item.actual_length
			}));
		});
	});
}

function getThickCategory() {
	clearThickCategory();
	clearItemQuantity();
	$.ajax({
		type: 'GET',
		url: "{{ url('getThickCategory') }}",
		data: {
			'item_id': $('#item_id').val(),
			'length_id': $('#lengthCategory').val(),
			'actual_length' : $('#actualLength').val()
		}
	}).done(function(result) {
		$.each(result, function (i, item) {
			$('#thickCategory').append($('<option>', {
				value: item.thick_id,
				text : item.thick
			}));
		});
	});
}

function getQuantity() {
	$.ajax({
		type: 'GET',
		url: "{{ url('getQuantity') }}",
		data: {
			'item_id': $('#item_id').val(),
			'length_id': $('#lengthCategory').val(),
			'actual_length' : $('#actualLength').val(),
			'thick_id' : $('#thickCategory').val()
		}
	}).done(function(result) {
		$.each(result, function (i, item) {
			$('.input-group').append('<span class="input-group-addon" id="itemQuantity">' + item.qty + ' lembar</span>');
		});
	});
}
</script>
@endsection
