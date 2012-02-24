$(document).ready( function(){
	var dropdown = $('div.btn-group');

	$('ul.dropdown-menu li a:not(.pro-stat)').on('click',function(){
		var statistic = $(this).text();
		$('a.btn.dropdown-toggle span.current-stat').text(statistic);
		drawGraph();
	});

	$('a.btn.dropdown-toggle').on('mouseover',function(){
		dropdown.addClass('open');
	});

	$('ul.dropdown-menu').on('mouseleave',function(){
		dropdown.removeClass('open');
	});
});
