<?php
//广告小工具
add_action('widgets_init', 'tux_banners');
function tux_banners() {
    register_widget('tux_banner');
}
class tux_banner extends WP_Widget {
    function tux_banner() {
        $widget_ops = array(
            'classname' => 'tux_banner',
            'description' => '显示一个广告(包括富媒体)'
        );
        $this->WP_Widget('tux_banner', '广告', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $code = $instance['code'];
        echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;		
        echo '<ul>' . $code . '</ul>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				广告名称：
				<input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				广告代码：
				<textarea id="<?php
        echo $this->get_field_id('code'); ?>" name="<?php
        echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php
        echo $instance['code']; ?></textarea>
			</label>
		</p>
<?php
    }
}

//Tux Tab
if( function_exists( 'register_sidebar_widget' ) ) {  
	    register_sidebar_widget('文章TAB','tux_posts_tab');
	}
	function tux_posts_tab() { include(TEMPLATEPATH . '/widget/posts-tab.php'); }