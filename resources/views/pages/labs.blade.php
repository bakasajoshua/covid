@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">All Cases</h5>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Testing Laboratory </th>
										<th>Pending Sample Results </th>
										<th>Number of samples since the last update </th>
										<th>Cumulative positives since last update </th>
										<th>Number of new samples </th>
										<th>Number of new positive samples </th>
										<th>Cumulative samples since onset of outbreak </th>
										<th>Cumulative positive samples since onset of outbreak </th>
										<th>Last Updated </th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $row)
										<tr>
											<td> {{ $row['lab'] }} </td>
											<td> {{ number_format($row['pending']) }} </td>
											<td> {{ number_format($row['prev_total']) }} </td>
											<td> {{ number_format($row['prev_pos']) }} </td>
											<td> {{ number_format($row['new_total']) }} </td>
											<td> {{ number_format($row['new_pos']) }} </td>
											<td> {{ number_format($row['pos']) }} </td>
											<td> {{ number_format($row['total']) }} </td>
											<td> {{ $row['last_updated'] }} </td>
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