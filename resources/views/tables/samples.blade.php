@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">Samples</h5>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered data-table">
								<thead>
									<tr>
										<th>Lab ID </th>
										<th>Identifier </th>
										<th>Name </th>
										<th>Date Collected </th>
										<th>Date Received </th>
										<th>Date Tested </th>
										<th>Received Status </th>
										<th>Result </th>
										<th>Edit </th>
									</tr>
								</thead>
								<tbody>
									@foreach($samples as $sample)
										<tr>
											<td> {{ $sample->id }} </td>
											<td> {{ $sample->identifier }} </td>
											<td> {{ $sample->patient_name }} </td>
											<td> {{ $sample->datecollected }} </td>
											<td> {{ $sample->datereceived }} </td>
											<td> {{ $sample->datetested }} </td>
											<td> {{ $sample->get_prop_name($received_statuses, 'receivedstatus') }} </td>
											<td> {!! $sample->get_prop_name($results, 'result', 'name_colour') !!} </td>
											<td> <a href="/covid_sample/{{ $sample->id }}/edit">Edit</a> </td>
										</tr>
									@endforeach
								</tbody>
							</table>

							@if($paginate)
								{{ $samples->links() }}
							@endif
						</div>
					</div>	
				</div>			
			</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {
		
        $('.data-table').DataTable({
            pageLength: 10,
            // responsive: true,
            dom: '<"html5buttons"B>lTfgitp',

		});
	});
</script>
@endsection