@extends('layouts.main')

@section('content')
	<div class="row text-center text-dark">
		<div class="card p-3 offset-md-4 col-md-4 my-1 text-white bg-info"> Kenya Covid-19 Situation  </div>
	</div>

	<div class="row text-center text-dark">			
		<div class="card p-2 mb-3 col-md-3">
			<b> Confirmed Cases </b>
			<span class="text-secondary"> {{ number_format($positives) }} </span> 
		</div>	
		<div class="card p-2 mb-3 col-md-3">
			<b> Current In Hospital </b>
			<span class="text-warning"> {{ number_format($hospitalised) }} ({{ round($hospitalised / $positives * 100) }}%) </span> 
		</div>
		<div class="card p-2 mb-3 col-md-3"> 
			<b> Discharged </b> 
			<span class="text-success"> {{ number_format($discharged) }} ({{ round($discharged / $positives * 100) }}%) </span> 
		</div>				
		<div class="card p-2 mb-3 col-md-3"> 
			<b> Deceased </b>
			@if($deceased)
				<span class="text-danger"> {{ number_format($deceased) }} ({{ round($deceased / $positives * 100) }}%) </span>
			@else 
				<span class="text-success"> {{ number_format($deceased) }} ({{ round($deceased / $positives * 100) }}%) </span> 
			@endif
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


	<div class="row text-dark">
		<div class="card mb-3 col-md-9">
			<h5 class="card-header">Age Distribution</h5>
			<div class="card-body">
				<div class="col-md-12" id="pyramid">
					
				</div>
			</div>	
		</div>			
		<div class="card mb-3 col-md-3">
			<h5 class="card-header">Gender</h5>
			<div class="card-body">
				<div class="col-md-12" id="gender_pie">
					
				</div>
			</div>	
		</div>			
	</div>

	<div class="row text-dark">
		<div class="card mb-3 col-md-12">
			<h5 class="card-header">Confirmed Cases By County</h5>
			<div class="card-body">
				<div class="col-md-12" id="county_chart">
					
				</div>
			</div>	
		</div>			
	</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {

		$("#confirmed_cases").load("/charts/daily_view");
		$("#county_chart").load("/charts/county_chart");
		$("#gender_pie").load("/charts/gender_pie");
		$("#pyramid").load("/charts/pyramid");
		$("#result_outcomes").load("/charts/outcomes");

	});
</script>
@endsection