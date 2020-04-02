@extends('layouts.main')

@section('content')

			<div class="row text-center text-dark">
				<div class="card p-1 my-1 col-md-4"><b> Date </b> {{ date('Y-m-d') }} </div>
				<div class="card p-3 col-md-4 my-1 text-white bg-info"> Kenya Covid-19 Situation  </div>
				<div class="card p-1 my-1 col-md-4"><b> Last Updated </b> {{ date('Y-m-d') }} </div>				
			</div>
			<div class="row text-center text-dark">
				<div class="card p-2 mb-3 col-md-3"> <b> Date of 1st Case </b> Mar 13 </div>
				<div class="card p-2 mb-3 col-md-3"> <b> Suspected Cases </b> {{ number_format($total) }} </div>				
				<div class="card p-2 mb-3 col-md-3"> <b> Confirmed Cases </b> {{ number_format($positives) }} </div>				
				<div class="card p-2 mb-3 col-md-3"> <b> Deaths </b> 0</div>	
			</div>
			<div class="row text-dark">
				<div class="card mb-4 col-md-12">
					<h5 class="card-header">Confirmed Cases By County</h5>
					<div class="card-body">
						<div class="row">
							<div class="col-md-9" id="map_div">
								
							</div>
							<div class="col-md-3">
								<table class="table table-striped text-dark">
									<thead>
										<tr>
											<th> Confirmed Cases By County </th>
											<th>  </th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $row)
											<tr>
												<td> {{ $row['name'] }} </td>
												<td> {{ $row['value'] }} </td>
											</tr>
										@endforeach
									</tbody>
								</table>					
							</div>	
						</div>	
					</div>	
				</div>			
			</div>

			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Confirmed Cases</h5>
					<div class="card-body">
						<div class="col-md-12" id="confirmed_cases">
							
						</div>
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {

		$("#confirmed_cases").load("/charts/daily_view");
		$("#map_div").load("/charts/map_data");

	});
</script>
@endsection