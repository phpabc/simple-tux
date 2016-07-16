jQuery(document).ready(function(){
jQuery('#tab-title span').click(function(){
    jQuery(this).addClass("selected").siblings().removeClass();
    jQuery("#tab-content > ul").slideUp('1500').eq(jQuery('#tab-title span').index(this)).slideDown('1500');
});
});