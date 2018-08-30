$(document).ready(function(){
	$('#content-wrapper').attr("class", "left-column col-xs-12 col-sm-8 col-md-9");
	$('button[data-action="show-password"]').click(function(){
		if ($('input[name="password"]').attr("type") == "password") {
			$(this).html('<i class="fa fa-eye"></i>');	
		} else if ($('input[name="password"]').attr("type") == "text") {
			$(this).html('<i class="fa fa-eye-slash"></i>');
		}
	});
});