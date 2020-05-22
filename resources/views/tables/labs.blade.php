
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Testing Laboratory </th>
				<th> Cumulative number of samples tested as at last update </th>
				<th>Number of samples tested since last update </th>
				<th>Cumulative number of samples tested to date </th>
				<th>Positives </th>
				<th>Last Updated </th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $row)
				<tr>
					<td> {{ $row['lab'] }} </td>
					<td> {{ number_format($row['prev_total']) }} </td>
					<td> {{ number_format($row['new_total']) }} </td>
					<td> {{ number_format($row['total']) }} </td>
					<td> {{ number_format($row['pos']) }} </td>
					<td> {{ $row['last_updated'] }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>							
</div>