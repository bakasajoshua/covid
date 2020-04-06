@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Users</h5>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Name </th>
										<th>Email </th>
										<th>User Type </th>
										<th>Lab </th>
										<th>Edit </th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
										<tr>
											<td> {{ $user->name }} </td>
											<td> {{ $user->email }} </td>
											<td> {{ $user->user_type->name ?? '' }} </td>
											<td> {{ $user->lab->name ?? '' }} </td>
											<td> <a href="/user/{{ $user->id }}/edit">Edit</a> </td>
										</tr>
									@endforeach
								</tbody>
							</table>							
						</div>
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {


	});
</script>
@endsection