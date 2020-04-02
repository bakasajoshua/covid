@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">All Cases</h5>
					<div class="card-body">
						<div class="col-md-12">
							<!-- <table class="table table-bordered">
								<thead>
									<tr>
										<th>Lab </th>
										<th>Result </th>
										<th>Number </th>
									</tr>
								</thead>
								<tbody>
									@foreach($samples as $sample)
										<tr>
											<td> {{ $sample->lab }} </td>
											@if($sample->result == 1)
												<td> Negative  </td>
											@elseif($sample->result == 2)
												<td> Positive </td>
											@else
												<td> Pending </td>
											@endif
											<td> {{ $sample->sample_count }} </td>
										</tr>
									@endforeach
								</tbody>
							</table> -->


							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Lab </th>
										<th>Positives </th>
										<th>Negatives </th>
										<th>Total </th>
									</tr>
								</thead>
								<tbody>
									@foreach($data as $row)
										<tr>
											<td> {{ $row['lab'] }} </td>
											<td> {{ number_format($row['pos']) }} </td>
											<td> {{ number_format($row['neg']) }} </td>
											<td> {{ number_format($row['total']) }} </td>
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