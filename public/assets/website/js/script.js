// JavaScript Document
	
$(document).ready(function () {
	
$(".srchfld .del").click(function (){
	$(this).closest(".srchfld").find("input").val("");
	//alert();
	
});

$(window).scroll(function() {	
	var scrollHeight=$(window).scrollTop();
	if(scrollHeight>200){
		$(".top-arrow").fadeIn(1000);	
	}
	else{
		$(".top-arrow").fadeOut(1000);
	}
		
});
	
$(".top-arrow").click(function () {

        var selfe = $(this);
        var sectop = selfe.closest("body").find("header");
        $('html, body').animate({
            //alert();
            scrollTop: sectop.offset().top
        }, 1000);
        return false;
    });

$(".icon-ham").click(function(){
	$(".mobile-menu").fadeIn();
	
});	
$("#close-menu").click(function(){
	$(this).closest(".mobile-menu").fadeOut();
	
});	
	

$(".card-block").click(function(){
	$(".card-block").removeClass("selected");
	$(this).addClass("selected");
	
});	
	

	
});