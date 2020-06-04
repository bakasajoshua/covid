@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Organisations</h5>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Name </th>
										<th>Edit </th>
									</tr>
								</thead>
								<tbody>
									@foreach($organisations as $organisation)
										<tr>
											<td> {{ $organisation->name }} </td>
											<td> <a href="/organisation/{{ $organisation->id }}/edit">Edit</a> </td>
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