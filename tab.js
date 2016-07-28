jQuery(document).ready(function(){
 	function tabToggle(){$(".tab_menu li").mouseover(function(){$(this).addClass("current").siblings().removeClass(),$(".tab_content > ul").eq($(".tab_menu li").index(this)).fadeIn("fast").siblings().hide().css({opacity:1}).stop()});}
	tabToggle();
});
