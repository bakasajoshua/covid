@extends('layouts.main')

@section('css_scripts')
    
@endsection

@section('custom_css')
	<style type="text/css">
		.input-edit {
            background-color: #FFFFCC;
        }
        .input-edit-danger {
            background-color: #f2dede;
        }
	</style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
    
        <div class="hpanel" style="margin-top: 1em;margin-right: 2%;">
            <div class="panel-body" style="padding: 20px;box-shadow: none; border-radius: 0px;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover data-table" style="font-size: 10px;margin-top: 1em;width: 100%">
                    <thead>               
                        <tr>
                            <th>Lab Name</th>
                            <th>Week</th>
                            <th>Start of Week</th>
                            <th>End of Week</th>
                            <th>Show</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($consumptions as $key => $consumption)
                        <tr>
                            <td>{{ $consumption->lab->name ?? '' }}</td>
                            <td>{{ $consumption->week ?? '' }}</td>
                            <td>{{ $consumption->start_of_week ?? '' }}</td>                            
                            <td>{{ $consumption->end_of_week ?? '' }}</td>
                            <td><a href="/kits/report/{{ $consumption->id }}" class="btn btn-primary btn-sm">Show</a></td>
                        </tr>
                    @empty
                    	<tr>
                    		<td colspan="5">No Consumption data submitted</td>
                    	</tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    
</script>
@endsection
