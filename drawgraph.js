var getState = function(){
	var obj = {};
	obj.player_names = $('select').val();
	return obj;
}

var drawGraph = function(width,height){
	if (typeof chart != 'undefined' ) chart.showLoading();
	$.post( 'config.php', getState(), function(resp){
		var config = $.extend( true, resp, {
			chart: {
				renderTo: 'graph',
				animation: false,
				width: width,
				height: height,
				backgroundColor: 'transparent',
				fontFamily: 'Ubuntu',
				zoomType: 'x'
			},
			credits: {
				enabled: false
			},
			plotOptions: {
				series: {
					connectNulls: true,
					lineWidth:5,
					animation: false,
					marker: {
						enabled: false,
						fillColor:'#FFFFFF',
						lineWidth:4,
						radius:4,
						lineColor:null,
						states: {
							hover: {
								enabled: true
							}
						}
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
						temp += '<a style="color:'+points[j].series.color+';">' +points[j].series.name+': '+points[j].y+'</a><br>';
					});
					return temp.slice(0,-4);
				}
			},
			legend: {
				enabled: false
			},
			//	itemStyle: {
			//		fontFamily: 'Ubuntu',
			//	},
			//	borderColor: 'white',
			//	borderRadius:0,
			//	align: 'center',
			//	verticalAlign: 'bottom',
			//	floating: false,
			//	margin: 30,
			//	symbolWidth:50
			//},
			xAxis: {
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
			},
			title: {
				text: null,
			},
		});
		chart = new Highcharts.Chart( config );
	}, 'json' );
};

var $window = $(window);

var resizeWidth = function(){
	$window.resize( function(){
		return $('.container-fluid').width();
	});
};

var resizeHeight = function(){
	$window.resize( function(){
		var height = window.innerHeight;
		var lessThan = height - 65;
		$('#graph').css('height',lessThan);
		return lessThan;
	});
};

$(document).ready( function(){
	drawGraph(resizeWidth(), resizeHeight());

	$('select').chosen().on('change',function(){
		drawGraph(resizeWidth(), resizeHeight());
	});

	$('.search-choice-close').click( function(){
		console.log($(this).prev().text()); /* the one that was just closed */
	});
});
