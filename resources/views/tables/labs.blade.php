
<div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Testing Laboratory </th>
				<th> Cumulative number of samples tested as at last update </th>
				<th>Number of samples tested since last update </th>
				<th>Cumulative number of samples tested to date </th>
				<th>Cumulative Positives </th>
				<th> Rejected Samples </th>
				<th> Collection to Receipt </th>
				<th> Receipt to Testing </th>
				<th> Testing to Dispatch </th>
				<th> Collection to Dispatch </th>
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
					<td> {{ number_format($row['rejected']) }} </td>

					<td> {{ number_format($row['tat1']) }} </td>
					<td> {{ number_format($row['tat2']) }} </td>
					<td> {{ number_format($row['tat3']) }} </td>
					<td> {{ number_format($row['tat4']) }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>							
</div>