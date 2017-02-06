</div>
<div id="footer">
&copy;2010-2016 PHPABC.CN版权所有 &nbsp;
浙ICP备16004727号 &nbsp;
<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=33010402001198">浙公网安备 33010402001198号</a>
<span class="power-by"> Powered by <a href="http://wordpress.org/" rel="external nofollow" target="_blank">WordPress</a>,
Theme by <a href="http://www.phpabc.cn/simple-tux.html" title="Simple Tux" target="_blank">PHPABC</a></span>
</div>
<?php wp_footer(); ?>
<div id="totop" class="totop"><i class="iconfont">&#xe61d;</i>回顶部</div>
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
