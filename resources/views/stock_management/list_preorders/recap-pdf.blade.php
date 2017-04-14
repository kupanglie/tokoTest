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
			<h1>REKAP BARANG MASUK</h1>
		</div>
		<div class="col-sm-12">
			<div class="col-sm-6" style="padding-left:0">
				<span>Kepada Yth,</span>
				<address>
					<strong>PLASWOOD INDONESIA</strong><br>
					Citra Garden 3 Blok A12/15<br>
					Kalideres - Jakarta Barat<br>
				</address>
			</div>
			<div class="col-sm-6 text-right">
				<h4>Preorder No.</h4>
				<h4 class="text-navy">{{ $preorder->no_preorder }}</h4>
			</div>
		</div>
	</div>
	<div class="table-responsive m-t" style="font-size:12px">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th style="width:5%">NO</th>
					<th>JENIS BARANG</th>
					<th>PANJANG</th>
					<th>HARGA SATUAN</th>
					<th colspan="2">SURAT JALAN</th>
					<th colspan="2">BARANG MASUK</th>
					<th>JUMLAH</th>
					<th colspan="2">SELISIH BARANG</th>
					<th>SELISIH UANG</th>
					<th>KETERANGAN</th>
				</tr>
			</thead>
			<tbody>
				@for($i=0;$i<count($items);$i++)
					<tr>
						<td>{{ $i+1 }}</td>
						<td>{{ $items[$i]->name }}</td>
						<td>{{ $items[$i]->length }}</td>
						<td>{{ $items[$i]->price }}</td>
						<td>{{ $items[$i]->qty }}</td>
						<td>
							@if(substr($items[$i]->name, 0, 2) == 'UP')
								LEMBAR
							@else
								BATANG
							@endif
						</td>
						<td>{{ $items[$i]->actual_qty }}</td>
						<td>
							@if(substr($items[$i]->name, 0, 2) == 'UP')
								LEMBAR
							@else
								BATANG
							@endif
						</td>
						<td>Rp {{ $items[$i]->actual_qty * $items[$i]->price }}</td>
						<td>{{ $items[$i]->qty - $items[$i]->actual_qty }}</td>
						<td>
							@if(substr($items[$i]->name, 0, 2) == 'UP')
								LEMBAR
							@else
								BATANG
							@endif
						</td>
						<td>Rp {{ ($items[$i]->qty - $items[$i]->actual_qty)  * $items[$i]->price }}</td>
						<td>
							@if($items[$i]->qty - $items[$i]->actual_qty == 0 || ($items[$i]->qty - $items[$i]->actual_qty)  * $items[$i]->price == 0)
								OK
							@else
								MASALAH
							@endif
						</td>
					</tr>
				@endfor
			</tbody>
		</table>
	</div>
	<div class="row">
		<div class="col col-md-6">
			Sudah di email tanggal {{ $preorder_date }}
		</div>
		<div class="col col-md-6 text-right">
			Hormat Kami,<br>
			UD. Panca Sakti<br><br><br><br><br>
			Fransiscus Xaverius Endrue Lie
		</div>
	</div>
</div>
@endsection

@section('custom-js')
<script type="text/javascript">
	window.print();
</script>
@endsection
