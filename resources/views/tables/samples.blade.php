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
										@if($param == 2)
											<th>Lab </th>
										@endif
										<th>Identifier </th>
										<th>Name </th>

										@if($param != 2)
											<th>Date Collected </th>
											<th>Date Received </th>
											<th>Received Status </th>
										@else
											<th> Age </th>
											<th> Sex </th>
											<th> Telephone number </th>
											<th> County </th>
											<th> Subcounty </th>
											<th> Travel history (Y/N) </th>
											<th> Where From </th>
											<th> History of contact with confirmed case </th>
											<th> Facility Name (Quarantine/health facility) </th>
											<th> Name of confirmed case </th>
										@endif

										<th>Test Type </th>
										<th>Result </th>
										<th>Date Tested </th>

										@if($param != 2)
											<th>Edit </th>
										@endif
									</tr>
								</thead>
								<tbody>
									@foreach($samples as $sample)
										<tr>
											<td> {{ $sample->id }} </td>
											@if($param == 2)
												<td> {{ $sample->lab->name ?? '' }} </td>
											@endif

											<td> {{ $sample->identifier }} </td>
											<td> {{ $sample->patient_name }} </td>

											@if($param != 2)
												<td> {{ $sample->datecollected }} </td>
												<td> {{ $sample->datereceived }} </td>
												<td> {{ $sample->get_prop_name($received_statuses, 'receivedstatus') }} </td>
											@else
												<td> {{ $sample->age }} </td>
												<td> {{ $sample->gender }} </td>
												<td> {{ $sample->phone_no }} </td>
												<td> {{ $sample->county }} </td>
												<td> {{ $sample->subcounty }} </td>
												<td>  </td>
												<td>  </td>
												<td>  </td>
												<td> {{ $sample->facilityname }} </td>
												<td>  </td>

											@endif

											<td> {!! $sample->get_prop_name($test_types, 'test_type') !!} </td>
											<td> {!! $sample->get_prop_name($results, 'result', 'name_colour') !!} </td>
											<td> {{ $sample->datetested }} </td>
											@if($param != 2)
												<td> <a href="/covid_sample/{{ $sample->id }}/edit">Edit</a> </td>
											@endif
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
		@if(!$paginate)
	        $('.data-table').DataTable({
	            pageLength: 10,
	            // responsive: true,
	            dom: '<"html5buttons"B>lTfgitp',

			});
		@endif
	});
</script>
@endsection