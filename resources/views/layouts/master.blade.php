
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- about this site -->
		<meta name="description" content="A web platform for partner performance.">
		<meta name="keywords" content="Kenya, Covid, Covid-19, Corona">
		<meta name="author" content="CHAI">
		<meta name="Resource-type" content="Document">

		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />


		<link rel='stylesheet' href='//cdn.datatables.net/1.10.12/css/jquery.dataTables.css' type='text/css' />
		<link rel='stylesheet' href='//cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css' type='text/css' />
		<link rel='stylesheet' href='//cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.css' type='text/css' />

	    @yield('css_scripts')

		<!-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}" /> -->
		<!-- <link rel="stylesheet" href="{{ asset('css/custom-2.css') }}" /> -->

		<link rel=icon href="/img/kenya-coat-of-arms.png" type="image/png" />
		<title> Covid Dashboard </title>
	</head>
	<body>
		<div class="container-fluid bg-light">

			<nav class="nav navbar navbar-expand-lg navbar-light"  style="background-color: #e3f2fd;">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto justify-content-center">					
						<li class="nav-item active"> <a class="nav-link" href="/">Home</a> </li>
					</ul>
				</div>				
			</nav>

			<div>
				@yield('content')
			</div>
		</div>

		<div id="errorModal">
			
		</div>
		<!-- End of Dashboard area -->
	</body>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-124819698-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-124819698-1');
	</script> -->

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->



	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>


	<script src="/highmaps/highcharts.js" type='text/javascript'></script>
	<script src="/highmaps/highcharts-more.js" type='text/javascript'></script>
	<script src="/highmaps/modules/map.js" type='text/javascript'></script>
	<script src="/highmaps/modules/data.js" type='text/javascript'></script>
	<script src="/highmaps/modules/drilldown.js" type='text/javascript'></script>

	<script src='//cdn.datatables.net/1.10.12/js/jquery.dataTables.js' type='text/javascript'></script>
	<script src='//cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.js' type='text/javascript'></script>
	<script src='//cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js' type='text/javascript'></script>
	<script src='//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js' type='text/javascript'></script>
	<script src='//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js' type='text/javascript'></script>
	<script src='//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js' type='text/javascript'></script>

	<!-- <script src="{{ url('js/customFunctions1.4.js') }}"></script> -->

	<script type="text/javascript">
	    $(function() {
	    	
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	        @php
	            $toast_message = session()->pull('toast_message');
	            $toast_error = session()->pull('toast_error');
	        @endphp
	        
	        @if($toast_message)
	            setTimeout(function(){
	                toastr.options = {
	                    closeButton: false,
	                    progressBar: false,
	                    showMethod: 'slideDown',
	                    timeOut: 10000
	                };
	                @if($toast_error)
	                    toastr.error("{!! $toast_message !!}", "Warning!");
	                @else
	                    toastr.success("{!! $toast_message !!}");
	                @endif
	            });
	        @endif
		    

		    @if(session('financial'))
		    	$(".filters").select2();
		    	set_select_facility("filter_facility", "{{ url('/facility/search') }}", 3, "Search for facility");
		    @else
			    $('#errorAlertDateRange').hide();
			    $(".js-example-basic-single").select2();
			    $("#breadcrum").html("{!! $default_breadcrumb ?? '' !!}");
		    @endif		    

			$("select").change(function(){
				em = $(this).val();
				id = $(this).attr('id');

				var posting = $.post( "{{ url('filter/any') }}", { 'session_var': id, 'value': em } );

				posting.done(function( data ) {
					console.log(data);
					reload_page();
				});

				posting.fail(function( data ) {
					location.reload(true);
					/*console.log(data);
		            setTimeout(function(){
		                toastr.options = {
		                    closeButton: false,
		                    progressBar: false,
		                    showMethod: 'slideDown',
		                    timeOut: 10000
		                };
	                    toastr.error("Kindly reload the page.", "Notice!");
		            });*/
				});
			});		    

		      //Getting the URL dynamically
			/*var url = $(location).attr('href');
			// Getting the file name i.e last segment of URL (i.e. example.html)
			var fn = url.split('/').indexOf("partner");

			if (fn > -1) {
				var trends = url.split('/').indexOf("trends");
				if (trends > -1) {
					$('#year-month-filter').hide();
					$('#date-range-filter').hide();
				}
			}*/
	    });

	</script>


    @yield('scripts')
</html>
		