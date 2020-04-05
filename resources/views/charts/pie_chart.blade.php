<div id="{{$div}}"></div>

@if(isset($paragraph))
	{!! $paragraph !!}
@endif


<script type="text/javascript">
	$().ready(function(){

		$('#{{$div}}').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
			    text: ''
			},
			tooltip: {
			    pointFormat: '{series.name}:  <b> {point.y} ({point.percentage:.1f}%)</b>'
			},
			plotOptions: {
			    pie: {
			        allowPointSelect: true,
			        cursor: 'pointer',
			        dataLabels: {
			            enabled: true,
			            format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)',
			            style: {
			                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
			            }
			        },
			        @if(isset($donut))
			        	// center: ['50%', '75%'],
			        	// startAngle: -90,
			        	// endAngle: 90,
			        	size: '70%',
			        @endif
			        showInLegend: true
			    }
			},
            colors: [
                '#F2784B',
                '#1BA39C',
                '#913D88'
            ],     
            series: [{!! json_encode($outcomes) !!}]

		});
    });
</script>
