@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">User</h5>
					<div class="card-body">
						<form action="/user/{{ $user->id ?? '' }}" method="POST" class="val_form">
							@csrf
							@isset($user) @method('PUT') @endisset

							<?php $m = $user ?? null; ?>

							@include('partials.input', ['model' => $m, 'prop' => 'name', 'label' => 'Name', 'required' => true, ])

							@include('partials.input', ['model' => $m, 'prop' => 'email', 'label' => 'Email', 'required' => true, 'input_type' => 'email' ])

							@include('partials.input', ['model' => $m, 'prop' => 'password', 'label' => 'Password', 'required' => true, 'input_type' => 'password' ])


							@if(auth()->user()->user_type_id == 1)
								@include('partials.select', ['model' => $m, 'prop' => 'user_type_id', 'items' => $user_types, 'required' => true, 'label' => 'User Type'])

								@include('partials.select', ['model' => $m, 'prop' => 'organisation_id', 'items' => $organisations, 'label' => 'Organisation'])

								@include('partials.select', ['model' => $m, 'prop' => 'lab_id', 'items' => $labs, 'label' => 'Lab'])
							@endif

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