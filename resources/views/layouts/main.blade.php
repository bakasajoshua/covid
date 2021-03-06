
<!DOCTYPE html>
<html lang="en">

<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel=icon href="/img/kenya-coat-of-arms.png" type="image/png" />
	<title> Covid Dashboard </title>

	<!-- Custom fonts for this template-->
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- <script src="https://use.fontawesome.com/5e1c4f503b.js"></script> -->

	<link href="/fontawesome-free/css/all.min.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="/DataTables/datatables.min.css" rel="stylesheet">

	<!-- <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet"> -->
	<link href="/css/sb-admin-2.css" rel="stylesheet">

	@yield('css')

</head>

<body id="page-top">

	<div id='app'>

		<!-- Page Wrapper -->
		<div id="wrapper">

			<!-- Content Wrapper -->
			<div id="content-wrapper" class="d-flex flex-column">

				<!-- Main Content -->
				<div id="content">

					<!-- Topbar -->
					<nav class="navbar navbar-expand navbar-light bg-white topbar mb-2 static-top shadow" style="height: 3.25rem;">

						<ul class="nav nav-tabs">

							@if(in_array(auth()->user()->user_type_id, [1, 2, 3]))
								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/"> Home</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/labs"> Labs</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/covid_sample/index/1">Neg Samples</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/covid_sample/index/2">Pos Samples</a>
								</li>
							@endif

							@if(in_array(auth()->user()->user_type_id, [1, 3]))

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/covid_sample/index/3">Samples Pending Results</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/covid_sample">All Samples</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/covid_sample/create">Create Sample</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/kits/report">Kits</a>
								</li>

							@endif

							@if(in_array(auth()->user()->user_type_id, [1]))
								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/kits/report/daily">Daily Reports</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/user"> Users</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/user/create">Create User</a>
								</li>

							@endif

							@if(in_array(auth()->user()->user_type_id, [1]))

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/organisation"> Orgs</a>
								</li>

								<li class="nav-item text-dark">
									<a class="nav-link text-dark font-weight-bold" href="/organisation/create">Create Org</a>
								</li>

							@endif
							
						</ul>

						<!-- Topbar Navbar -->
						<ul class="navbar-nav ml-auto">

							<div class="topbar-divider d-none d-sm-block"></div>

							@auth
								<!-- Nav Item - User Information -->
								<li class="nav-item dropdown no-arrow">
									<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
										<span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ auth()->user()->name }} </span>
										<!-- <img class="img-profile rounded-circle" src=""> -->
									</a>
									<!-- Dropdown - User Information -->
									<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
											<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
											Logout
										</a>
									</div>
								</li>
							@endauth

						</ul>

					</nav>
					<!-- End of Topbar -->

					<!-- Begin Page Content -->
					<div class="container-fluid">
					@yield('content')

					</div>
					<!-- /.container-fluid -->

				</div>
				<!-- End of Main Content -->

				<!-- Footer -->
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; NPHL {{ date('Y') }} </span>
					</div>
					</div>
				</footer>
				<!-- End of Footer -->

			</div>
			<!-- End of Content Wrapper -->

		</div>
		<!-- End of Page Wrapper -->

		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
		</a>

		<!-- Logout Modal-->
		<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<form action="{{ route('logout') }}" method="POST" >
						@csrf
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<button class="btn btn-primary" type="submit">Logout</button>
					</form>
				</div>
			</div>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	
	<!-- DataTables JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>

	<script src="/js/sb-admin-2.min.js"></script>


	<script src="/highmaps/highcharts.js" type='text/javascript'></script>
	<script src="/highmaps/highcharts-more.js" type='text/javascript'></script>
	<script src="/highmaps/modules/map.js" type='text/javascript'></script>
	<script src="/highmaps/modules/data.js" type='text/javascript'></script>
	<script src="/highmaps/modules/drilldown.js" type='text/javascript'></script>

	<script type="text/javascript">

		function set_warning(message)
		{
			setTimeout(function(){
				toastr.options = {
					closeButton: true,
					progressBar: true,
					showMethod: 'slideDown',
					timeOut: 6000,
					preventDuplicates: true
				};
				toastr.warning(message);
			});
		}

		function getLocation(){
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(showPosition, showError);                    
			}
			else{
				alert("Geolocation is not supported by this browser.");
			}
		}

		function display_modal(body, label=null, footer=null) {
			$('#randomModalBody').html(body);
			$('#randomModalLabel').html(label);
			$('#randomModalFooter').html(footer);
			$('#randomModal').modal('show');
		}

		function showPosition(position) {
			/*console.log("Latitude is "+ position.coords.latitude);
			console.log("Longitude is "+ position.coords.longitude);
			var d = new Date(position.timestamp);
			console.log("timestamp is "+ d.toTimeString());
			console.log(position);*/

			body = "Latitude is "+ position.coords.latitude+"<br />"+"Longitude is "+ position.coords.longitude+"<br />"+"Accuracy is "+ position.coords.accuracy;
			display_modal(body, 'Current Location');

			$.post({
				data: position,
				url: "{{ url('location') }}",
				success: function(data){
					// console.log(data);
				}
			});
		}

		function showError(error){
			var e;
			switch(error.code){
				case error.PERMISSION_DENIED:
					e = 'PERMISSION_DENIED';
					break;
				case error.POSITION_UNAVAILABLE:
					e = 'POSITION_UNAVAILABLE';
					break;
				case error.TIMEOUT:
					e = 'TIMEOUT';
					break;
				case error.UNKNOWN_ERROR:
					e = 'UNKNOWN_ERROR';
					break;
			}
			display_modal('Your location could not be retrieved.', 'Location Error', e);
			// console.log(error);
		}
		
			// URL example is /consignment/search
			function set_select(div_name, url, minimum_length, placeholder, send_url=false) {
					div_name = '#' + div_name;      

					$(div_name).select2({
							minimumInputLength: minimum_length,
							placeholder: placeholder,
							ajax: {
									delay   : 100,
									type    : "POST",
									dataType: 'json',
									data    : function(params){
											return {
													search : params.term
											}
									},
									url     : function(params){
											params.page = params.page || 1;
											return  url + "?page=" + params.page;
									},
									processResults: function(data, params){
											return {
													results     : $.map(data.data, function (row){
															return {
																	text    : row[row.prop_name],
																	id      : row.id        
															};  
															
													}),
													pagination  : {
															more: data.to < data.total
													}
											};
									}
							}
					});

					if(send_url != false)
							set_change_listener(div_name, send_url);
			}

			function set_change_listener(div_name, url)
			{
					// substract the /search portion from the URL
					url = url.substring(0, url.length-7);
									
					$(div_name).change(function(){
							var val = $(this).val();
							window.location.href = url + '/' + val;
					}); 
			}
		
		$(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});


		});

		


	</script>

	@yield('scripts')

</body>

</html>
