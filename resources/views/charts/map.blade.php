<div style="height: 700px;" id="{{$div}}"></div>

<script type="text/javascript">
	$(function() {
		$.get("/maps/kenya.json", function(datam, status){
			var api_data=datam.data;
			mapDIV = "{{$div}}";

			var data = Highcharts.geojson(api_data),
				separators = Highcharts.geojson(api_data, 'mapline'),
				// Some responsiveness
				small = $('#'+mapDIV).width() < 400;

			console.log(data);

			var chart;

			//Instantiate the map
			Highcharts.mapChart(mapDIV, {
				chart: {

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
					name: 'Confirmed Cases',
					dataLabels: {
						enabled: true,
						format: '<b>{point.properties.name}</b>'
					},
					mapData: data,
					data: {!! json_encode($data) !!},
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
			});
		});
	});
  

 
</script>