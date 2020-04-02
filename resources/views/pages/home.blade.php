@extends('layouts.main')

@section('content')
	<div class="row text-center text-dark">
		<div class="card p-3 .offset-md-4 col-md-4 my-1 text-white bg-info"> Kenya Covid-19 Situation  </div>
	</div>

	<div class="row text-center text-dark">			
		<div class="card p-2 mb-3 col-md-3">
			<b> Confirmed Cases </b>
			<span class="text-secondary"> {{ number_format($positives) }} </span> 
		</div>	
		<div class="card p-2 mb-3 col-md-3">
			<b> Current In Hospital </b>
			<span class="text-warning"> {{ number_format($hospitalised) }} </span> 
		</div>
		<div class="card p-2 mb-3 col-md-3"> 
			<b> Discharged </b> 
			<span class="text-success"> {{ number_format($discharged) }} </span> 
		</div>				
		<div class="card p-2 mb-3 col-md-3"> 
			<b> Deceased </b>
			@if($deceased)
				<span class="text-danger"> {{ number_format($deceased) }} </span>
			@else 
				<span class="text-success"> {{ number_format($deceased) }} </span> 
			@endif
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