$(document).ready(function(){
	$('body').keypress(function (e) {
	 	var key = e.which;
	 	if(key == 13){
			$('#login-btn').click();
			return false;  
		}
	});
});
