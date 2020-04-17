@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-4 col-md-12">
					<h5 class="card-header">Confirmed Cases By County</h5>
					<div class="card-body">
						<div class="row">
							<div class="col-md-9" id="map_div">
								
							</div>
						</div>	
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {

		$("#map_div").load("/charts/map_data");

	});
</script>
@endsection