@extends('layouts.apps')

@section('title')
Bravo Bangunan
@endsection

@section('content')
<div class="ibox-content p-xl">
	<div class="row">
		<div class="col-sm-12">
			<address>
				<strong>UD. PANCA SAKTI</strong><br>
				Jln. Jend. Sudirman No. 94<br>
				Telp. (0380) 827324<br>
				Kota Kupang - NTT - Indonesia
			</address>
		</div>
		<div class="col-sm-12">
			<h1>OPNAME ITEMS</h1>
			<h4>{{ date('d F Y') }}</h4>
		</div>
	</div>
	<div class="table-responsive m-t" style="font-size:12px">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width:5%">NO</th>
					<th>JENIS BARANG</th>
					<th>PANJANG</th>
					<th>QTY</th>
					<th>OPNAME QTY</th>
					<th>SATUAN</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<count($item_mappings);$i++)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $item_mappings[$i]->name }}</td>
						<td>{{ $item_mappings[$i]->actual_length }}</td>
						<td>{{ $item_mappings[$i]->qty }}</td>
						<td></td>
						<td>
							@if(substr($item_mappings[$i]->name, 0, 2) == 'UP')
								LEMBAR
							@else
								BATANG
							@endif
						</td>
					</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript">
	window.print();
</script>
@endsection
