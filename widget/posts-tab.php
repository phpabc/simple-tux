<?php
//切换标签插件
class tux_tab extends WP_Widget {

	function tux_tab() {
		$widget_ops = array('description' => '显示热门文章、最新文章、随机文章 Tab 小工具');
		$this->WP_Widget('tux_tab', 'Tab 工具', $widget_ops);
	}

	function form($instance) {
		$days = isset($instance['days']) ? absint($instance['days']) : 90;
		$posts_num = isset($instance['posts_num']) ? absint($instance['posts_num']) : 10;
		$order = isset($instance['orderby']) ? absint($instance['orderby']) : 评论次数;
		$orderby = array('评论数量','浏览次数');
?>
	<p><label for="<?php echo $this->get_field_id('posts_num'); ?>"><?php _e('文章数量：'); ?></label>
		<input id="<?php echo $this->get_field_id('posts_num'); ?>" name="<?php echo $this->get_field_name('posts_num'); ?>" type="text" value="<?php echo $posts_num; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('days'); ?>"><?php _e('统计天数：'); ?></label>
		<input id="<?php echo $this->get_field_id('days'); ?>" name="<?php echo $this->get_field_name('days'); ?>" type="text" value="<?php echo $days; ?>" size="3" /></p>
	<p><label for="<?php echo $this->get_field_id('orderby'); ?>" id="<?php echo $instance['orderby'];?>"><?php _e('排序方式：'); ?></label>
		<select name="<?php echo $this->get_field_name('orderby'); ?>"><?php foreach ($orderby as $order){ echo'<option value="'.$order.'"';if ($instance['orderby']==$order){ echo 'selected="selected"';}?>><?php echo $order;?></option><?php }?></select></p>
<?php
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$posts_num = absint($instance['posts_num']);
		$days = absint($instance['days']);
		$order = $instance['orderby'];
		echo $before_widget;
		echo cy_widget_tab($posts_num,$days,$order);
		echo $after_widget;
	}
}
register_widget('tux_tab');

function cy_widget_tab($posts_num,$days,$order){
?>
<ul class="tab_menu btn">
<li class="current">热门文章</li><li>最新发布</li><li>随机推荐</li>
</ul>
<div class="tab_content" style="clear:both;">
<ul>
<?php 
global $wpdb;
if ($order == "浏览次数"){
$posts = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER BY views DESC LIMIT $posts_num");
}
else {
$posts = $wpdb->get_results("SELECT ID , post_title , comment_count FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' OR $wpdb->posts.`post_status` = 'inherit') ORDER BY comment_count DESC LIMIT 0 , $posts_num ");
}
foreach($posts as $post) :?>
<li><a href="<?php echo get_permalink( $post->ID ); ?>" rel="external"><?php echo $post->post_title; ?></a></li>
<?php endforeach;?>
</ul>
<ul class="hide"><?php $myposts = get_posts("numberposts=$posts_num&offset=0");foreach($myposts as $post) :?>
<li><a href="<?php echo get_permalink( $post->ID ); ?>" rel="external"><?php echo $post->post_title; ?></a></li>
<?php endforeach; ?>
</ul>
<ul class="hide"><?php $myposts = get_posts("numberposts=$posts_num&orderby=rand");foreach($myposts as $post) :?>
<li><a href="<?php echo get_permalink( $post->ID ); ?>" rel="external"><?php echo $post->post_title; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<?php
}
?>