</div>
<div id="footer">
	&copy;<?php echo stripslashes(get_option('tux_years')); ?>-<?php echo date("Y")?> <?php bloginfo('name'); ?>版权所有 &nbsp;
    <?php echo stripslashes(get_option('tux_icp')); ?> &nbsp;
	<?php echo stripslashes(get_option('tux_tongji')); ?>
   	<span class="power-by">	Powered by <a href="http://wordpress.org/" rel="external nofollow" target="_blank">WordPress</a>,
    Theme by <a href="http://www.phpabc.cn/simple-tux.html" title="Simple Tux" target="_blank">PHPABC</a></span>

</div>
<?php wp_footer(); ?>
<div id="totop" class="totop"><i class="iconfont">&#xe810;</i>回顶部</div>
<script type="text/javascript">
	$(window).scroll(function () {
        var dt = $(document).scrollTop();
        var wt = $(window).height();
        if (dt <= 0) {
            $("#totop").hide();
            return;
        }
        $("#totop").show();
        if ($.browser.msie && $.browser.version == 6.0) {//IE6返回顶部
            $("#totop").css("top", wt + dt - 110 + "px");
        }
    });
    $("#totop").click(function () { $("html,body").animate({ scrollTop: 0 }, 200) });
</script>

</body>
</html>
