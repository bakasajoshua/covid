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
                            <th>Material Number</th>
                            <th>Product Description</th>
                            <th>Begining Balance</th>
                            <th>Received From KEMSA</th>
                            <th>Used</th>
                            <th>Positive Adjustments</th>
                            <th>Negative Adjustments</th>
                            <th>Losses/Wastage</th>
                            <th>Ending Balance</th>
                            <th>Requested</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($consumption->details as $key => $detail)
                        <tr>
                            <td>{{ $detail->kit->material_no }}</td>
                            <td>{{ $detail->kit->product_description }}</td>
                            <td>{{ $detail->begining_balance }}</td>
                            <td>{{ $detail->received }}</td>
                            <td>{{ $detail->kits_used }}</td>
                            <td>{{ $detail->positive }}</td>
                            <td>{{ $detail->negative }}</td>
                            <td>{{ $detail->wastage }}</td>
                            <td>{{ $detail->ending }}</td>
                            <td>{{ $detail->requested }}</td>
                        </tr>
                    @endforeach
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
