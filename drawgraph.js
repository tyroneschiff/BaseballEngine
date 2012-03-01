var $window = $(window),
		navHeight = $('div.navbar').outerHeight(),
		wellHeight = $('div.well').outerHeight(),
		playerInput = $('input.span2.player');

var getPlayers = function(statistic, type){
	$.getJSON( "array.php", {statistic:statistic,type:type}, function(resp){
		playerInput.each( function(){
			$(this).typeahead().data('typeahead').source = resp;
		});
	});
}

var getTopThree = function(statistic, type){
	$.getJSON( "top.php", {statistic:statistic,type:type}, function(resp){
			playerInput.each( function(i){
				$(this).val( resp[i] );
			});
			drawGraph();
	});
}

var getState = function(){
	var obj = {};
	obj.player_names = [];
	playerInput.each( function(i,inp){
		var val = $(inp).val();
		if ( val.length > 0  )
			obj.player_names.push( val );
	});
	obj.statistic = $('a.btn.dropdown-toggle span.current-stat:visible').text();
	obj.type = $('div.btn-group button.btn.active').data('pos');
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

var resizeWidth = function(){
	$window.resize( function(){
		var windowWidth = $(this).width(),
				els = $('#graph, div.row-fluid');
		( windowWidth < 960 ) ? els.css('width',windowWidth-20) : els.css('width','960');
	});
};

var resizeHeight = function(){
	$window.resize( function(){
		var height = ($window.innerHeight()*0.95) - (navHeight + wellHeight);
		$('#graph').css('height',height);
		return height;
	});
};

var clickPlayer = function(){
	playerInput.on('change',function(){
		var ind = $(this).index(),
			indString = ind.toString(),
			typeaheadUl = $("ul.typeahead.dropdown-menu:eq("+ind+")").not('[id]').attr('id',indString),
			player = $("#"+indString).find('li.active').data('value');
		$("div.player-select input:eq("+ind+")").val( player );
		drawGraph();
	});
};

var enterPlayer = function(){
	playerInput.on('keyup',function(e){
		if ( e.keyCode == 13 ) {
			var ind = $(this).index(),
				indString = ind.toString(),
				typeaheadUl = $("ul.typeahead.dropdown-menu:eq("+ind+")").not('[id]').attr('id',indString),
				player = $("#"+indString).find('li.active').data('value');
			$("div.player-select input:eq("+ind+")").val( player );
			drawGraph();
		}
	});
};

$(document).ready( function(){
	getPlayers("BE Score", "Batter");
	getTopThree("BE Score", "Batter");

	drawGraph(resizeHeight(), resizeWidth());

	$('#graph').css({
		'height':($window.innerHeight()*0.95) - (navHeight + wellHeight),
	});

	clickPlayer();
	enterPlayer();

	$('input').on('click',function(){
		$(this).select();
	});
	
	$('div.btn-group button.btn').on('click', function(){
		var type = $(this).data('pos'),
				typeSibling = $(this).siblings().data('pos'),
				playerInput = $('input.span2.player'),
				statistic = $('ul.dropdown-menu li a:first').text();
		playerInput.val('');
		$(".stat-select-"+type).show();
		$(".stat-select-"+typeSibling).hide();
		$('.current-stat').text( statistic );
		getPlayers( statistic, type );
		getTopThree( statistic, type );
	});

});
