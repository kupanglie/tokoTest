<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>@yield('title')</title>

	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/footable/footable.core.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

</head>

<body>
	<div id="wrapper">
		@include('partials.left-sidebar')

		<div id="page-wrapper" class="gray-bg">
			@include('partials.header')
			<div class="wrapper wrapper-content">
				@yield('content')
			</div>
			<div class="footer">
				@include('partials.footer')
			</div>
		</div>
		@include('partials.right-sidebar')
	</div>

	<!-- Mainly scripts -->
	<script src="{{ asset('assets/js/jquery-2.1.1.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

	<!-- Flot -->
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/flot/jquery.flot.time.js') }}"></script>

	<!-- Peity -->
	<script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
	<script src="{{ asset('assets/js/demo/peity-demo.js') }}"></script>

	<!-- Custom and plugin javascript -->
	<script src="{{ asset('assets/js/inspinia.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

	<!-- Jvectormap -->
	<script src="{{ asset('assets/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

	<!-- EayPIE -->
	<script src="{{ asset('assets/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

	<!-- Sparkline -->
	<script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Sparkline demo data  -->
	<script src="{{ asset('assets/js/demo/sparkline-demo.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/footable/footable.all.min.js') }}"></script>

	<script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/select2/select2.full.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

	<!-- Data picker -->
	<script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

	@yield('custom-js')
</body>
</html>
