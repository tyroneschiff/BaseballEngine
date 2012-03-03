var select = $(".card-expiry-month"),
		month = new Date().getMonth() + 1;
for ( var i = 1; i <= 12; i++ ){
	select.append( $("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
}
