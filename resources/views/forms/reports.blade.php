@extends('layouts.main')

@section('css')
	<link href="/datepicker/datepicker3.css" rel="stylesheet">
	<link href="/select2/select2.min.css" rel="stylesheet">

    <style type="text/css">
        .form-horizontal .control-label {
                text-align: left;
            }
    </style>
@endsection

@section('content')
	<div class="row text-dark">
		<div class="card mb-3 col-md-12">
			<h5 class="card-header">Test Outcome Report [ All Tested Samples ]</h5>
			<div class="card-body">
				<div id="confirmed_cases">
					<form method="post" action="/kits/report/daily" class="form-horizontal" id="covid_reports_form">
                		@csrf()
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <strong>Date Filter<div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" id="date_filter" required class="form-control" value="{{ date('Y-m-d') }}" name="date_filter">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">
                                <strong>Select Report Type<div style='color: #ff0000; display: inline;'>*</div></strong>
                            </label>
                            <div class="col-sm-9">
                                <label> <input type="radio" name="types" value="daily_results_submission" class="i-checks" checked="true" required> Daily Laboratory Results Submission </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <center>
                                <button type="submit" class="btn btn-primary" id="generate_report">Generate Report</button>
                                <button class="btn btn-default">Reset Options</button>
                            </center>
                        </div>           
                    </form>
				</div>
			</div>	
		</div>			
	</div>

@endsection


@section('scripts')
	<script src="/datepicker/bootstrap-datepicker.js"></script>
	<script src="/select2/select2.full.min.js"></script>
	<script src="/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(function() {
	        $(".date").datepicker({
	            startView: 0,
	            todayBtn: "linked",
	            keyboardNavigation: false,
	            forceParse: true,
	            autoclose: true,
	            endDate: new Date(),
	            format: "yyyy-mm-dd"
	        });
	            
	        $('select').select2({
	            placeholder: "Select One",
	            allowClear: true        	
	        });

			$(".val_form").validate({
				errorPlacement: function (error, element){
					element.before(error);
				}
			});
		});
	</script>
@endsection