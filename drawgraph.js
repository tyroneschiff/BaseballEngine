var before = $('select').val();
var bool = false;

var moveUniquesToEnd = function( one, two ){
	for ( var i in two ){
		var person = two[i];
		var ind = one.indexOf( person );
		if ( ind == -1 )
			one.push( person );
	}
	return one;
};

var removePlayer = function( one, two ){
	for ( var i in two ){
		var person = two[i];
		var ind = one.indexOf( person );
		if ( ind == -1 )
			two.splice( two.indexOf( person ), 1 );
	}
	return two;
}

var getState = function( bool, state ){
	var obj = {};
	if ( bool ){
		obj.player_names = state;
	} else {
		obj.player_names = before;
	}
	obj.statistic = $('a.btn.dropdown-toggle span.current-stat').text();
	return obj;
}

$('select').on('change',function(){
	bool = true;	
	var current = $('select').val();
	if ( !current ){
		before = [];
	} else if ( before.length > current.length ) {	
		var after = removePlayer( current, before );
		getState( bool, after );
		before = after;
	} else {
		var after = moveUniquesToEnd( before, current );
		getState( bool, after );
		before = after;
	}
});

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
						lineWidth:3,
						radius:6,
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

var $window = $(window),
		navHeight = ($('div.navbar').outerHeight())*0.8,
		wellHeight = ($('div.well').outerHeight())*0.8;

var resizeWidth = function(){
	$window.resize( function(){
		return $('.container-fluid').width();
	});
};

var resizeHeight = function(){
	$window.resize( function(){
		var height = $window.innerHeight() - (navHeight + wellHeight);
		$('#graph').css('height',height);
		return height;
	});
};

$(document).ready( function(){
	$('#graph').css('height', $window.innerHeight() - (navHeight + wellHeight) );
	
	drawGraph(resizeWidth(), resizeHeight());

	$('select').chosen().on('change',function(){
		drawGraph(resizeWidth(), resizeHeight());
	});

});
