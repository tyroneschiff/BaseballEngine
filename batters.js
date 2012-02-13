$(document).ready( function(){
	$.post("batters.php", function(resp){	
		$('form input').attr('data-source', resp );
	});
});
