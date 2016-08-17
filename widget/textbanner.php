<?php
add_action('widgets_init', 'tux_textbanners');
function tux_textbanners() {
    register_widget('tux_textbanner');
}
class tux_textbanner extends WP_Widget {
    function __construct() {
        $widget_ops = array(
            'classname' => 'tux_textbanner',
            'description' => '显示一个文本特别推荐'
        );
        $this->WP_Widget('tux_textbanner', '文字推荐', $widget_ops);
    }
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_name', $instance['title']);
        $content = $instance['content'];
        $link = $instance['link'];
        $blank = $instance['blank'];
        $lank = '';
        if ($blank) $lank = ' target="_blank"';
        echo $before_widget;
        echo '<a href="' . $link . '"' . $lank . '>';
        echo '<h3>' . $title . '</h3>';
        echo '<p>' . $content . '</p>';
        echo '</a>';
        echo $after_widget;
    }
    function form($instance) {
?>
		<p>
			<label>
				名称：
				<input id="<?php
        echo $this->get_field_id('title'); ?>" name="<?php
        echo $this->get_field_name('title'); ?>" type="text" value="<?php
        echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				描述：
				<textarea id="<?php
        echo $this->get_field_id('content'); ?>" name="<?php
        echo $this->get_field_name('content'); ?>" class="widefat" rows="3"><?php
        echo $instance['content']; ?></textarea>
			</label>
		</p>
		<p>
			<label>
				链接：
				<input style="width:100%;" id="<?php
        echo $this->get_field_id('link'); ?>" name="<?php
        echo $this->get_field_name('link'); ?>" type="url" value="<?php
        echo $instance['link']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php
        checked($instance['blank'], 'on'); ?> id="<?php
        echo $this->get_field_id('blank'); ?>" name="<?php
        echo $this->get_field_name('blank'); ?>">新打开浏览器窗口
			</label>
		</p>
<?php
    }
}