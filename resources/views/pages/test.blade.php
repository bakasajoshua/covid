@extends('layouts.main')

@section('content')


	<div class="row text-dark">
		<div class="card mb-4 col-md-8">
			<h5 class="card-header">Confirmed Cases By County</h5>
			<div class="card-body">
				<div class="row" id="map_div">

				</div>	
			</div>	
		</div>

		<div class="card mb-3 col-md-4">
			<h5 class="card-header">Summarised Outcomes</h5>
			<div class="card-body">
				<div id="result_outcomes">
					
				</div>
			</div>	
		</div>						
	</div>

@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {

		$("#map_div").load("/charts/map_data");
		$("#result_outcomes").load("/charts/outcomes");

	});
</script>
@endsection