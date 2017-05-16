function LoadBarchart(id, title, keys, values, measure, label){
	$(id).highcharts({
		chart: {type: 'column'},
		title: {text: title},
		xAxis: {categories: keys},
		yAxis: {min: 0, title: {text: ''}},
        legend:false,
		plotOptions: {column: {pointPadding: 0.1,borderWidth: 0}},
        credits: { enabled: false },

		series: [{
		    color: '#009447',
		    data: values
		}]
	});
}


function LoadCircular(id, title, data){
    $(id).highcharts({
        chart: {plotBackgroundColor: null,plotBorderWidth: 1,plotShadow: false},
        title: {text: title},
        tooltip: {pointFormat: '{series.name}: <b>{point.y}</b>'},
        plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.y}',
        style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'}}}},
        series: [{
            type: 'pie',
            name: title,
            data: data,
        }]
    });
}

function LoadTimeseriesChart(container, data) {
    $('#'+container).highcharts({
        credits: { enabled: false },
        chart: { zoomType: 'x' },
        title: { text: '' },
        xAxis: { type: 'datetime' },
        yAxis: { min:1, title: { text: '' } },
        legend: { enabled: false },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: { radius: 1 },
                lineWidth: 1,
                states: { hover: { lineWidth: 1 } },
                threshold: null
            }
        },

        series: [{
            type: 'area',
            data: data
        }]
    });
}


