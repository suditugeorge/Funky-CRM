<!DOCTYPE HTML>
<html>
	<head>
		<title>@yield('title') - Funky Catalog</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">

	    <link rel="stylesheet" href="{{ URL::asset('css/layout/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/mdb.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/toastr.css') }}" />

		@stack('styles')

	</head>

	<body class="fixed-sn cyan-skin">
		<input type="hidden" name="_token" value="{{Session::token()}}">
		@include('dashboard.navigation')
		@yield('content')
		<script type="text/javascript" src="{{ URL::asset('js/layout/jquery-3.1.1.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/layout/tether.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/layout/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/layout/mdb.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/layout/toastr.js') }}"></script>
	    <script>
	    // Data Picker Initialization
	    $('.datepicker').pickadate();


	    // Material Select Initialization
	    $(document).ready(function() {
	        $('.mdb-select').material_select();
	    });

	    // Sidenav Initialization
	    $(".button-collapse").sideNav();
	    var el = document.querySelector('.custom-scrollbar');
	    Ps.initialize(el);

	    // Tooltips Initialization
	    $(function() {
	        $('[data-toggle="tooltip"]').tooltip();
	    });
	    </script>
		@stack('scripts')
	</body>
</html>
