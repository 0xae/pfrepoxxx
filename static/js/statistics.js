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
        chart: { 
            zoomType: 'x'
        },
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

function LoadPieChart(container, title, data) {
    /*
    var data = [{
        name: 'Microsoft Internet Explorer',
        y: 56.33
    }, {
        name: 'Chrome',
        y: 24.03,
        sliced: true,
        selected: true
    }, {
        name: 'Firefox',
        y: 10.38
    }, {
        name: 'Safari',
        y: 4.77
    }, {
        name: 'Opera',
        y: 0.91
    }, {
        name: 'Proprietary or Undetectable',
        y: 0.2
    }];
    */

    Highcharts.chart(container, {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            width: 370,
            height: 370,
            type: 'pie'
        },
        title: {text: 'Revenue Per Producer'},
        credits: { enabled: false },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: { enabled: false },
                showInLegend: true
            }
        },
        series: [{
            name: 'Percentage',
            colorByPoint: true,
            data: data
        }]
    });
}

// 'container'
function LoadGrowthSeries(el, cats, unit, data)  {
    Highcharts.chart(el , {
        title: {text: ''},
        subtitle: { text: '' },
        credits: { enabled: false },
        yAxis: {
            title: {
                text: ''
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
         xAxis: {
             categories: cats
        },
        series: [{
            name: unit,
            data: data
        }]
    });
}

