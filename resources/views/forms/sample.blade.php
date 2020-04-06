@extends('layouts.main')

@section('css')
	<link href="/datepicker/datepicker3.css" rel="stylesheet">
@endsection

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Sample</h5>
					<div class="card-body">
						<form action="/covid_sample/{{ $covidSample->id ?? '' }}" method="POST"  class="val_form">
							@csrf
							@isset($covidSample) @method('PUT') @endisset

							<?php $m = $covidSample ?? null; ?>

							@include('partials.input', ['model' => $m, 'prop' => 'identifier', 'label' => 'Identifier', 'disabled' => true, 'default_val' => $covidSample->patient->identifier])

							@include('partials.date', ['model' => $m, 'prop' => 'datereceived', 'label' => 'Date Received', 'required' => true])

							@include('partials.select', ['model' => $m, 'prop' => 'receivedstatus', 'items' => $received_statuses, 'required' => true, 'label' => 'Received Status'])

							@include('partials.date', ['model' => $m, 'prop' => 'datetested', 'label' => 'Date Tested'])

							@include('partials.select', ['model' => $m, 'prop' => 'result', 'items' => $results, 'label' => 'Result'])

							@include('partials.submit', ['model' => $m])

							
						</form>
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')
	<script src="/datepicker/bootstrap-datepicker.js"></script>
	<script src="/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(function() {
        $('.date-field').datepicker( "option", "dateFormat", 'yy-mm-dd' );

		$(".val_form").validate({
			errorPlacement: function (error, element){
				element.before(error);
			}
		});
	});
</script>
@endsection