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
						<tbody>
							@foreach($my_data as $row)
								<tr>
									<td> {{ $row->name ?? '' }} </td>
									<td> {{ $row->value ?? '' }} </td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
				</div>


					
				</div>
			</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$(function() {
        $.get("/maps/kenya.json", function(datam, status){
        	var api_data=datam.data;
        	mapDIV = 'mapdiv';

		    var data = Highcharts.geojson(api_data),
		        separators = Highcharts.geojson(api_data, 'mapline'),
		        // Some responsiveness
		        small = $('#'+mapDIV).width() < 400;

		    // Set drilldown pointers
		    $.each(data, function (i, v) {
		        this.drilldown = this.properties['code'];
		        var county_name = this.properties['name'].replace(" ", "_").replace("'", "").replace("-", "_").toLowerCase();
		        //Get facility count 
		        this.value = 0;
		        /*if(county_name in chart_data){
		        	this.value = chart_data[county_name]['total'];
		    	}*/
		    });

		    var chart;

		    //Instantiate the map
		    Highcharts.mapChart(mapDIV, {
		        chart: {
		            events: {
		                drilldown: function (e) {
		                	// console.log(e)
		                    if (!e.seriesOptions) {
		                        var county_name = e.point.name.replace(" ", "_").replace("'", "").replace("-", "_").toLowerCase();
		                        chart = this,
		                            mapKey = 'maps/counties/' + county_name + '.json' ,
		                            // Handle error, the timeout is cleared on success
		                            fail = setTimeout(function () {
		                                if (mapKey) {
		                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);
		                                    fail = setTimeout(function () {
		                                        chart.hideLoading();
		                                    }, 1000);
		                                }
		                            }, 3000);



		                        // Show the spinner
		                        chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner

		                        $.get('/maps/counties/' + county_name + '.json', function(datam, status){
		                            data = Highcharts.geojson(datam.data);
		                            //Get facility count
		                            $.each(data, function (i, v) {
		                            	var subcounty_name = v.properties.name.replace(" ", "_").replace("'", "").replace("-", "_").toLowerCase();
		                            	this.value = 0;
		                                /*if(county_name in chart_data){
		                                	//Confirm subcounty
		                                	if(subcounty_name in chart_data[county_name]['subcounties']){
								        		this.value = chart_data[county_name]['subcounties'][subcounty_name]['total'];
								        	}
								    	}*/
								    });

		                            // Hide loading and add series
		                            chart.hideLoading();
		                            clearTimeout(fail);
		                            chart.addSeriesAsDrilldown(e.point, {
		                                name: e.point.name,
		                                data: data,
		                                dataLabels: {
		                                    enabled: true,
		                                    format: '{point.name}'
		                                }
		                            });

		                            //Update facilities/partners
		                            chart.update({
									    tooltip: {
									      	formatter: function() {
									      		var subcounty_name = this.key.replace(" ", "_").replace("'", "").replace("-", "_").toLowerCase();
									      		var rV = '<b>' + this.key + '</b><br/>';
		                                		/*if(county_name in chart_data){
		                                			//Confirm subcounty
		                                			if(subcounty_name in chart_data[county_name]['subcounties']){
								        				$.each(chart_data[county_name]['subcounties'][subcounty_name]['facilities'], function(i, facility_name){
								        					if(i == 0){
								        						rV += '<span><b>Total</b></span>: ' + Highcharts.numberFormat(chart_data[county_name]['subcounties'][subcounty_name]['total'], 0)+'<br/>';
								        					}
								        					rV += facility_name+'<br/>';
								        				});
								        			}else{
								        				rV += '<span><b>Total</b></span>: 0 <br/>';
								        			}
								    			}*/
							                    return rV;
									      	}
									    }
									});
		                        });
		                    }

		                    this.setTitle(null, { text: e.point.name });
		                },
		                drillup: function (e) {
		                    this.setTitle(null, { text: '' });
		                    chart.update({
							    tooltip: {
							      	formatter: function() {
							      		var county_name = this.key.replace(" ", "_").replace("'", "").replace("-", "_").toLowerCase();
							      		var rV = '<b>' + this.key + '</b><br/>';
                                		/*if(county_name in chart_data){
                                			rV += '<span><b>Total</b></span>: ' + Highcharts.numberFormat(chart_data[county_name]['total'], 0)+'<br/>';
						    			}else{
					        				rV += '<span><b>Total</b></span>: 0 <br/>';
					        			}*/
					                    return rV;
							      	}
							    }
							});
		                }
		            }
		        },

		        title: {
		            text: 'Covid-19 in Kenya '
		        },

		        subtitle: {
		            text: 'Source:www.covid-19.org'
		        },

		        legend: small ? {} : {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle'
		        },
		        credits: false,
		        colorAxis: {
		            min: 0,
		            minColor: '#aaaebc',
		            maxColor: '#008080'
		        },

		        mapNavigation: {
		            enabled: true,
		            buttonOptions: {
		                verticalAlign: 'bottom'
		            }
		        },

		        plotOptions: {
		            map: {
		                states: {
		                    hover: {
		                        color: '#ee6e6e'
		                    }
		                }
		            },
		            series: {
		            	events: {
		            		click: function(p){
		            			console.log(p.point.properties)
		            		}
		            	}
		            },
		        },

		        series: [{
		            // data: data,
		            name: 'Kenya',
		            dataLabels: {
		                enabled: true,
		                format: '{point.properties.name}'
		            },
		            mapData: data,
		            data: {!! json_encode($my_data) !!},
		            joinBy: ['OBJECTID', 'id']

		        }, {
		            type: 'mapline',
		            data: separators,
		            color: 'silver',
		            enableMouseTracking: false,
		            animation: {
		                duration: 500
		            }
		        }],

		        drilldown: {
		            activeDataLabelStyle: {
		                color: '#FFFFFF',
		                textDecoration: 'none',
		                textOutline: '1px #000000'
		            },
		            drillUpButton: {
		                relativeTo: 'spacingBox',
		                position: {
		                    x: 0,
		                    y: 60
		                }
		            }
		        }
		    });
		});
	});
</script>
@endsection