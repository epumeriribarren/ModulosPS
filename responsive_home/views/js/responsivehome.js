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