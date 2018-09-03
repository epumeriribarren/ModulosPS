ocularSlider();
$(window).resize( function () {
	ocularSlider();
});

function ocularSlider() {
	if($(document).width()<=953){
		$(".flexslider").css("display","none");
	}else{
		$(".flexslider").css("display","block");
	}
}

$(document).ready(function(){
	$('#content-wrapper').attr("class", "left-column col-xs-12 col-sm-8 col-md-9");
	$('button[data-action="show-password"]').click(function(){
		if ($(this).parent().parent().find('.form-control.js-child-focus.js-visible-password').attr("type") == "password") {
			$(this).html('<i class="fa fa-eye"></i>');	
		} else if ($(this).parent().parent().find('.form-control.js-child-focus.js-visible-password').attr("type") == "text") {
			$(this).html('<i class="fa fa-eye-slash"></i>');
		}
	});
});