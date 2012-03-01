$(document).ready( function(){
	$('ul.dropdown-menu li a:not(.pro-stat)').on('click',function(){
		var statistic = $(this).text(),
				type = $('div.btn-group button.btn.active').data('pos'); 
		$('a.btn.dropdown-toggle span.current-stat').text(statistic);
		getPlayers( statistic, type );
		drawGraph();
	});
});
