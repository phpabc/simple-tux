<?php
//最近评论插件
class tux_comment extends WP_Widget {

	function tux_comment() {
		$widget_ops = array('description' => '显示最新评论');
		$this->WP_Widget('tux_comment', '最新评论', $widget_ops);
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$limit = isset($instance['limit']) ? absint($instance['limit']) : 8;
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('标题：'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

	<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('评论数量：'); ?></label>
		<input id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" size="3" /></p>
<?php
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('最新评论', 'tux_comment') : $instance['title']);
		$limit = absint($instance['limit']);
		echo $before_widget.$before_title.$title.$after_title;
		echo cy_widget_comment($limit);
		echo $after_widget;
	}
}
function remove_comments_widget() {
	unregister_widget('WP_Widget_Recent_Comments');
}
add_action( 'widgets_init', 'remove_comments_widget' );

register_widget('tux_comment');
function cy_widget_comment($limit){
?>
<ul class="tux_comment">
        <?php
			global $wpdb;
			$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,comment_author_url,comment_author_email, SUBSTRING(comment_content,1,33) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND user_id='0' ORDER BY comment_date_gmt DESC LIMIT $limit";
			$comments = $wpdb->get_results($sql);
			$output = $pre_HTML;
			foreach ($comments as $comment) {$output .= "\n<li>".strip_tags($comment->comment_author).":<br />" . " <a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"评论来源: " .$comment->post_title . "\">" . strip_tags($comment->com_excerpt)."</a></li>";}
			$output .= $post_HTML;
			$output = convert_smilies($output);			
			echo $output;
		?>
</ul>
<?php }?>