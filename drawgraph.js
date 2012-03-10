var $window = $(window),
		navHeight = $('div.navbar').outerHeight(),
		wellHeight = $('div.well').outerHeight(),
		playerInput = $('input.span2.player'),
		select_month = $(".card-expiry-month"),
		select_year = $(".card-expiry-year"),
		month = new Date().getMonth() + 1,
		year = new Date().getFullYear();

var getPlayers = function(statistic, type){
	$.getJSON( "/array.php", {statistic:statistic,type:type}, function(resp){
		playerInput.each( function(){
			var opts = {};
			opts.filter = function ( val ) {
				return val.replace( /\([^\)]+\)$/, '' );
			};
			$(this).typeahead( opts ).data('typeahead').source = resp;
		});
	});
}

var getTopThree = function(statistic, type){
	$.getJSON( "/top.php", {statistic:statistic,type:type}, function(resp){
			var players = [];
			for ( var i in resp )
				players.push( resp[i].replace( /\([^\)]+\)$/, '' ) );
			playerInput.each( function(i){
				$(this).val( players[i] );
			});
			drawGraph();
	});
}

var getState = function(){
	var obj = {};
	obj.player_names = [];
	playerInput.each( function(i,inp){
		var val = $(inp).val().replace( /\([^\)]+\)$/, '' );
		if ( val.length > 0  )
			obj.player_names.push( val );
		else
			obj.player_names.push( null );
	});
	obj.statistic = $('a.btn.dropdown-toggle span.current-stat:visible').text();
	obj.type = $('div.btn-group button.btn.active').data('pos');
	return obj;
}

var linearRegression = function(y,x){
	var lr = {},
	n = y.length,
	sum_x = 0,
	sum_y = 0,
	sum_xy = 0,
	sum_xx = 0,
	sum_yy = 0,
	denominator = Math.sqrt((n*sum_xx-sum_x*sum_x)*(n*sum_yy-sum_y*sum_y));

	for (var i = 0; i < y.length; i++) {
		sum_x += x[i];
		sum_y += y[i];
		sum_xy += (x[i]*y[i]);
		sum_xx += (x[i]*x[i]);
		sum_yy += (y[i]*y[i]);
	}

	lr['slope'] = (n * sum_xy - sum_x * sum_y) / (n*sum_xx - sum_x * sum_x);
	lr['intercept'] = (sum_y - lr.slope * sum_x)/n;
	( denominator == 0 ) ? lr['r2'] = 100 : lr['r2'] = Math.pow((n*sum_xy - sum_x*sum_y)/denominator,2);

	return lr;
}

var isEmpty = function(obj) {
	var p;
	for (p in obj) {
		if (obj.hasOwnProperty(p)) {
			return false;
		}
	}
	return true;
};

var drawGraph = function(width,height){
	if (typeof chart != 'undefined' ) chart.showLoading();
	$.post( '/config.php', getState(), function(resp){
		var known_x = [], known_y, lr;
		for ( i=1; i<=resp.series.length; i++){
			known_x.push(i);
		}
		for ( i=0; i<=resp.series.length; i++){
			if ( isEmpty(resp.series[i]) ){
				continue;
			}
			known_y = resp.series[i].data;
			lr = linearRegression( known_y, known_x );
		}
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
					lineWidth:4,
					animation: false,
					marker: {
						enabled: false,
						fillColor:'#FFFFFF',
						lineWidth:2,
						radius:5,
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
				gridLineWidth: 1,
				title: {
					text: null
				},
			},
			title: {
				text: null,
			},
			colors: [
				'#4572A7', 
				'#AA4643',
				'#89A54E',
				'#DB843D',
				'#3D96AE',
				'#80699B', 
				'#92A8CD', 
				'#A47D7C', 
				'#B5CA92'
			]
		});
		chart = new Highcharts.Chart( config );
	}, 'json' );
};

var resizeWidth = function(){
	$window.resize( function(){
		var windowWidth = $(this).width(),
				els = $('#graph, div.row-fluid');
		( windowWidth <= 960 ) ? els.css('width',windowWidth-20) : els.css('width','960px');
		if ( windowWidth >= 1440 )
			els.css('width',(windowWidth*(2/3)));
	});
};

var resizeHeight = function(){
	$window.resize( function(){
		var height = ($window.innerHeight()*0.95) - (navHeight + wellHeight);
		$('#graph').css('height',height);
		console.log(height);
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

window.onload = function(){ window.scrollTo(0,0); }

$(document).ready( function(){
	drawGraph(resizeHeight(), resizeWidth());
	
	getPlayers("BE Score", "Batter");
	getTopThree("BE Score", "Batter");

	$('#graph').css({
		'height':($window.innerHeight()*0.95) - (navHeight + wellHeight),
		'width' : function(){
			if ( $window.width() >= 1440 ) return ($window.width()*(2/3)-20);
			else  if ( $window.width() <= 960 ) return $window.width()-20;
			else return 960;
		}
	});

	$('div.well div.row-fluid').css({
		'width': function(){
			if ( $window.width() >= 1440 ) return ($window.width()*(2/3)-20);
			else if ( $window.width() <= 960 ) return $window.width()-20; 
			else return 960;
		},
		'min-width':790
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

	$('ul.dropdown-menu li a:not(.pro-stat)').on('click',function(){
		var statistic = $(this).text(),
				type = $('div.btn-group button.btn.active').data('pos');
		$('a.btn.dropdown-toggle span.current-stat').text(statistic);
		getPlayers( statistic, type );
		drawGraph();
	});

	$('.definition').popover();

	for ( var i = 1; i <= 12; i++ ){
		select_month.append( $("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
	}
	for ( var i = 0; i < 12; i++ ){
		select_year.append( $("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
	}

});
