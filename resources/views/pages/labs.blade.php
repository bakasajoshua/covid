@extends('layouts.main')

@section('content')


			<div class="row text-dark">
				<div class="card mb-3 col-md-12">
					<h5 class="card-header">All Cases</h5>
					<div class="card-body">
						<div class="col-md-12">
							<table >
								<thead>
									<tr>
										<th>Identifier </th>
										<th>Result </th>
									</tr>
								</thead>
								<tbody>
									@foreach($samples as $sample)
										<tr>
											<td> {{ $sample->identifier }} </td>
											@if($sample->result == 1)
												<td> Negative  </td>
											@elseif($sample->result == 2)
												<td> Positive </td>
											@else
												<td> Pending </td>
											@endif
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