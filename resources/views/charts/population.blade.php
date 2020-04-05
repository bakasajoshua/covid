<div id="{{$div}}"></div>

{!! $paragraph ?? '' !!}

<script type="text/javascript">
	
    $(function () {
        $('#{{$div}}').highcharts({
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            title: {
                text: ''
            },
            chart: {
                type: 'bar'
            },
            accessibility: {
                point:{
                    valueDescriptionFormat: '{index}. Age {xDescription}, {value}%.'
                }
            },
            xAxis: [
            {
                categories: {!! json_encode($categories ?? []) !!},
                reversed: false,
                accessibility:{
                    description: 'Age (male)'
                },
            },
            {
                categories: {!! json_encode($categories ?? []) !!},
                reversed: false,
                opposite: true,
                linkedTo: 0,
                accessibility:{
                    description: 'Age (female)'
                },
            }
            ],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function() {
                        return Math.abs(this.value);
                    }
                }
            },

            tooltip: {
                formatter: function(){
                    return '<b>' + this.series.name + ', age ' + this.point.category + '</b><br/>' + 'Positives: ' + Highcharts.numberFormat(Math.abs(this.point.y), 1) + '';
                }
            },
            navigation: {
                buttonOptions: {
                    verticalAlign: 'bottom',
                    y: -20
                }
            },
            series: {!! json_encode($outcomes) !!}
        });
    });
</script>