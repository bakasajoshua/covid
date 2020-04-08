@extends('layouts.main')

@section('css')
	<link href="/datepicker/datepicker3.css" rel="stylesheet">
	<link href="/select2/select2.min.css" rel="stylesheet">
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


	                        @include('partials.select', ['model' => $m, 'default_val' => $sample->patient->identifier_type ?? null, 'prop' => 'identifier_type', 'label' => 'Identifier Type', 'items' => $identifier_types])

	                        @include('partials.input', ['model' => $m, 'prop' => 'identifier', 'default_val' => $sample->patient->identifier ?? null, 'required' => true, 'label' => 'Patient Identifier'])

	                        @include('partials.select', ['model' => $m, 'default_val' => $sample->patient->county_id ?? null, 'prop' => 'county_id', 'label' => 'County', 'items' => $countys])



	                        @include('partials.input', ['model' => $m, 'prop' => 'patient_name', 'default_val' => $sample->patient->patient_name ?? null, 'label' => 'Patient Name'])

	                        @include('partials.input', ['model' => $m, 'prop' => 'email_address', 'default_val' => $sample->patient->email_address ?? null, 'label' => 'Email Address'])

	                        @include('partials.input', ['model' => $m, 'prop' => 'phone_no', 'default_val' => $sample->patient->phone_no ?? null, 'label' => 'Phone Number'])


	                        @include('partials.date', ['model' => $m, 'prop' => 'dob', 'required' => true, 'label' => 'Date of Birth', 'default_val' => $sample->patient->dob ?? null, 'class' => 'date-dob'])

	                        @include('partials.select', ['model' => $m, 'prop' => 'sex', 'default_val' => $sample->patient->sex ?? null, 'required' => true, 'label' => 'Sex', 'items' => $gender, 'prop2' => 'gender_description'])

	                        @include('partials.input', ['model' => $m, 'prop' => 'residence', 'default_val' => $sample->patient->residence ?? null, 'label' => 'Area of Residence'])

	                        <hr />

	                        @include('partials.select', ['model' => $m, 'required' => true, 'prop' => 'justification', 'label' => 'Justification', 'items' => $covid_justifications, 'default_val' => $sample->patient->justification ?? null])

	                        @include('partials.select', ['model' => $m, 'required' => true, 'prop' => 'test_type', 'label' => 'Test Type', 'items' => $covid_test_types, ])

	                        @include('partials.date', ['model' => $m, 'prop' => 'date_symptoms', 'label' => 'Date Symptoms Began Showing', 'default_val' => $sample->patient->date_symptoms ?? null,])

	                        @include('partials.date', ['model' => $m, 'prop' => 'date_admission', 'label' => 'Date of Admission to Hospital', 'default_val' => $sample->patient->date_admission ?? null,])

	                        @include('partials.input', ['model' => $m, 'prop' => 'hospital_admitted', 'default_val' => $sample->patient->hospital_admitted ?? null, 'label' => 'Hospital Admitted'])

	                        @include('partials.date', ['model' => $m, 'prop' => 'date_isolation', 'label' => 'Date of Isolation', 'default_val' => $sample->patient->date_isolation ?? null,])

	                        @include('partials.select', ['model' => $m, 'prop' => 'health_status', 'label' => 'Health Status', 'items' => $health_statuses])

	                        @include('partials.date', ['model' => $m, 'prop' => 'date_death', 'label' => 'Date of Death', 'default_val' => $sample->patient->date_death ?? null,])

	                        @include('partials.select_multiple', ['model' => $m, 'prop' => 'symptoms', 'label' => 'Symptoms', 'items' => $covid_symptoms])

	                        @include('partials.input', ['model' => $m, 'prop' => 'temperature', 'is_number' => true, 'label' => 'Temperature (Celcius)'])

	                        @include('partials.select_multiple', ['model' => $m, 'prop' => 'observed_signs', 'label' => 'Observed Signs', 'items' => $observed_signs])

	                        @include('partials.select_multiple', ['model' => $m, 'prop' => 'underlying_conditions', 'label' => 'Underlying Conditions', 'items' => $underlying_conditions])

	                        <hr />



	                        @include('partials.select', ['model' => $m, 'required' => true, 'prop' => 'sample_type', 'label' => 'Sample Type', 'items' => $covid_sample_types, ])

	                        @include('partials.date', ['model' => $m, 'required' => true, 'prop' => 'datecollected', 'label' => 'Date of Collection',])

							@include('partials.date', ['model' => $m, 'prop' => 'datereceived', 'label' => 'Date Received', 'required' => true])

							@include('partials.select', ['model' => $m, 'prop' => 'receivedstatus', 'items' => $receivedstatus, 'required' => true, 'label' => 'Received Status'])

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
	<script src="/select2/select2.full.min.js"></script>
	<script src="/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(function() {
        $('.date-field').datepicker( "option", "dateFormat", 'yy-mm-dd' );
        $('select').select2({
            placeholder: "Select One",
            allowClear: true        	
        });

		$(".val_form").validate({
			errorPlacement: function (error, element){
				element.before(error);
			}
		});
	});
</script>
@endsection