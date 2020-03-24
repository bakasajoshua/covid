@extends('layouts.master')

@section('content')

			<div class="row">
				<div class="col-md-4">Date: {{ date('Y-m-d') }} </div>
				<div class="col-md-4"></div>
				<div class="col-md-4">Last Updated: {{ date('Y-m-d') }} </div>				
			</div>
			<div class="row">
				<div class="col-md-4">Date of 1<sup>st</sup> case: </div>
				<div class="col-md-4">Confirmed Cases: </div>				
				<div class="col-md-4">Deaths: </div>				
			</div>
			<div class="row">

				<div class="col-md-9" style="height: 500px;" id="mapdiv">
					
				</div>
				<div class="col-md-3">
					<table class="table table-striped">
						<thead>
							<tr>
								<th> Cases By County </th>
								<th>  </th>
							</tr>
						</thead>
					</table>
					
				</div>


					
				</div>
			</div>
@endsection