@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Organisation</h5>
					<div class="card-body">
						<form action="/organisation/{{ $organisation->id ?? '' }}" method="POST" class="val_form">
							@csrf
							@isset($organisation) @method('PUT') @endisset

							<?php $m = $organisation ?? null; ?>

							@include('partials.input', ['model' => $m, 'prop' => 'name', 'label' => 'Organisation', 'required' => true, ])

							@include('partials.submit', ['model' => $m])
							
						</form>
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')
<script src="/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(function() {
		$(".val_form").validate({
			errorPlacement: function (error, element){
				element.before(error);
			}
		});
	});
</script>
@endsection