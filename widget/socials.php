<?php
//社交网站按钮小工具
add_action('widgets_init', 'tux_socials');
function tux_socials() {
    register_widget('tux_social');
}
class tux_social extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'tux_social',
            'description' => '在这里您的社交网站按钮'
        );
        $this->WP_Widget('tux_social', '社交按钮', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        echo $before_widget;
        echo '<div class="wid_social">';
        if (get_option('tux_weibo')) echo '<a href="' . get_option('tux_weibo') . '" rel="external nofollow" title="新浪微博" target="_blank"><i class="iconfont_social weibo">&#xe607;</i></a>';
        if (get_option('tux_tqq')) echo '<a  href="' . get_option('tux_tqq') . '" rel="external nofollow" title="腾讯微博" target="_blank"><i class="iconfont_social tweibo">&#xe621;</i></a>';
        if (get_option('tux_git')) echo '<a href="' . get_option('tux_git') . '" rel="external nofollow" title="GitHub" target="_blank"><i class="iconfont_social github">&#xe620;</i></a>';
        if (get_option('tux_baidu')) echo '<a href="' . get_option('tux_baidu') . '" rel="external nofollow" title="百度贴吧" target="_blank"><i class="iconfont_social baidu">&#xe60d;</i></a>';
        if (get_option('tux_google')) echo '<a href="' . get_option('tux_google') . '" rel="external nofollow" title="Google +" target="_blank"><i class="iconfont_social google+">&#xe60f;</i></a>';
        if (get_option('tux_weixin')) echo '<a class="weixin"><i class="iconfont_social weixin">&#xe619;</i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">订阅号“' . get_option('tux_weixin') . '”</div><div class="popover-content"><img width="200px" height="200px" src="' . get_option('tux_weixin_qr') . '" ></div></div></div></a>';		
        if (get_option('tux_pay')) echo '<a class="weixin"><i class="iconfont_social weixin">&#xe601;</i><div class="weixin-popover"><div class="popover bottom in"><div class="arrow"></div><div class="popover-title">支付宝“' . get_option('tux_pay') . '”</div><div class="popover-content"><img width="200px" height="200px" src="' . get_option('tux_pay_qr') . '" ></div></div></div></a>';
        if (get_option('tux_qqContact')) echo '<a href="tencent://message/?uin=' . get_option('tux_qqContact') . '&Site=&Menu=yes " rel="external nofollow" title="联系QQ" target="_blank"><i class="iconfont_social  qq">&#xe600;</i></a>';
        if (get_option('tux_facebook')) echo '<a href="' . get_option('tux_facebook') . '" rel="external nofollow" title="Facebook" target="_blank"><i class="iconfont_social facebook">&#xe60c;</i></a>';
        if (get_option('tux_twitter')) echo '<a href="' . get_option('tux_twitter') . '" rel="external nofollow" title="Twitter" target="_blank"><i class="iconfont_social twitter">&#xe60e;</i></a>';
        if (get_option('tux_linkedin')) echo '<a href="' . get_option('tux_linkedin') . '" rel="external nofollow" title="Linkedin" target="_blank"><i class="iconfont_social Linkedin">&#xe623;</i></a>';		
        if (get_option('tux_rss')) echo '<a href="' . get_option('tux_rss') . '" rel="external nofollow" target="_blank"  title="订阅本站"><i class="iconfont_social rss">&#xe608;</i></a>';
        echo '</div>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>显示一组社交图标，详细设置请至主题后台设置</p>
<?php
    }
}