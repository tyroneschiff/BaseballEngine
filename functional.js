$(document).ready( function(){
	var changeWidth = function(width){
		var dropdown = $('.chzn-drop');
		dropdown.css('width',width);
		return width;
	};

	var currentWidth = function(){
		return $('ul.chzn-choices').innerWidth();
	};

	var oWidth = $('div[id$="_chzn"]').width();

	changeWidth(oWidth);

	$('select').on('change',function(){
		var cWidth = currentWidth();
		console.log("oWidth:"+oWidth);
		if ( oWidth = currentWidth ) {
			var tWidth = currentWidth();
			var afterWidth = changeWidth( tWidth );
			oWidth = afterWidth;
			console.log(oWidth);
		} else {
			var afterWidth = changeWidth( cWidth );
			oWidth = afterWidth;
		}
	});
});
