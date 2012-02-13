var drawGraph = function(width,height){
	//if (typeof chart != 'undefined' )
	//	chart.showLoading();

	$.post( 'config.php', function(resp){
		var config = $.extend( true, resp, {
			chart: {
				renderTo: 'chart',
				animation: false,
				width: width,
				height: height,
				backgroundColor: 'transparent',
				fontFamily: 'Ubuntu'
			},
			credits: {
				enabled: true,
				text: 'BaseballEngine.com',
				href: 'http://www.baseballengine.com'
			},
			plotOptions: {
				series: {
					animation: false,
					marker: {
						fillcolor: '#FFFFFF',
						lineWidth: 2,
						lineColor: null
					}
				}
			},
			tooltip: {
				style: {
					padding: '10px'
				},
				shared: true,
				crosshairs: true,
				borderColor: '#000000',
				formatter: function(){
					var order = [], i, j, temp = [],
						points = this.points;
					for (i=0,j=0; i<points.length; i++){
						j=0;
						if ( order.length )
							while ( points[order[j]] && points[order[j]].y > points[i].y )
								j++;
							temp = order.splice(0, j);
							temp.push(i);
							order = temp.concat(order);
						}
					temp = '<b>'+this.x+'</b><br/>';
					$(order).each( function(i,j){
						temp += '<span style="color: '+points[j].series.color+'">' +points[j].series.name+': '+points[j].y+'</span><br/>';
					});
					return temp;
				}
			},
			legend: {
				itemStyle: {
					fontFamily: 'Ubuntu',
				},
				borderColor: '#000000',
				align: 'center',
				verticalAlign: 'bottom',
				floating: false,
				margin: 30,
			},
			xAxis: {
				tickInterval: 14,
				lineColor: '#000000',
				lineWidth: 2,
				labels: {
					style: {
						width: 100
					}
				}
			},
			yAxis: {
				lineColor: '#000000',
				lineWidth: 2,
				gridLineWidth: 0,
				title: {
					text: null
				},
				min: 0,
			},
			title: {
				text: null,
			},
		});
		chart = new Highcharts.Chart( config );
	}, 'json' );
};

var resizeWidth = function(){
	$(window).resize( function(){
		return $('.container-fluid').width();
	});
};

var resizeHeight = function(){
	$(window).resize( function(){
		var height = window.innerHeight;
		var lessThan = height - 60;
		$('#chart').css('height',lessThan);
		return lessThan;
	});
};

$(document).ready( function(){
	drawGraph(resizeWidth(),resizeHeight());
});
