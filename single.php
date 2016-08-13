<?php get_header(); ?>
	<div id="main">
		<?php while ( have_posts() ) : the_post(); ?>
		<div id="article">
			<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
			<div class="info">
				    <span class="meat_span"><i class="iconfont">&#xe611;</i><?php the_author() ?></span>
					<span class="meat_span"><i class="iconfont">&#xe60f;</i><?php the_category(', ') ?></span>
					<span class="meat_span"><i class="iconfont">&#xe614;</i><?php the_time('Y-m-d'); ?></span>
					<span class="meat_span"><i class="iconfont">&#xe608;</i><?php post_views(' ', ' 次浏览'); ?></span>					
                    <span class="meat_span meat_max"><i class="iconfont">&#xe605;</i><?php the_tags('', ', ', ''); ?></span>
                <span class="meat_span"><i class="iconfont">&#xe604;</i><?php comments_popup_link ('没有评论','1条评论','%条评论'); ?></span>
                <?php edit_post_link('编辑', '<span class="meat_span">', '</span>'); ?>
            </div>
			<div class="text"><?php the_content(); ?></div>
           <?php if (get_option('tux_content_ad') == 'tux_content_ad_1') { ?>
                <div class="content_adsense"><?php echo stripslashes(get_option('tux_content_adcode')); ?> </div>
		   <?php { echo ''; } ?><?php } else { } ?>			
			
			<!--相关文章开始-->
<div class="related">
<h3>和本文关系暧昧的</h3>
<ul>
<?php
global $post, $wpdb;
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
    $tag_list = '';
    foreach ($post_tags as $tag) {
        // 获取标签列表
        $tag_list .= $tag->term_id.',';
    }
    $tag_list = substr($tag_list, 0, strlen($tag_list)-1);

    $related_posts = $wpdb->get_results("
        SELECT DISTINCT ID, post_title
        FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
        WHERE {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
        AND ID = object_id
        AND taxonomy = 'post_tag'
        AND post_status = 'publish'
        AND post_type = 'post'
        AND term_id IN (" . $tag_list . ")
        AND ID != '" . $post->ID . "'
        ORDER BY RAND()
        LIMIT 5");
        // 以上代码中的 5 为限制只获取8篇相关文章
        // 通过修改数字 5，可修改你想要的文章数量

    if ( $related_posts ) {
        foreach ($related_posts as $related_post) {
?>
    <li><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><?php echo $related_post->post_title; ?></a></li>
<?php   }
    }
    else {
      echo '<li>暂无相关文章</li>';
    }
}
else {
  echo '<li>暂无相关文章</li>';
}
?>
</ul>
</div>
<!--相关文章结束-->
            <div class="text_add">
                <div class="share"><?php echo stripslashes(get_option('tux_share')); ?></div>
            </div>
		</div>
		<?php endwhile; ?>
        <div class="post_link">
			<div class="prev"><?php previous_post_link('上一篇：%link') ?></div>
			<div class="next"><?php next_post_link('下一篇：%link') ?></div>
        </div>
        
        <div id="comments"><?php comments_template(); ?></div>
	</div>
	<?php get_sidebar('single'); ?>
<?php get_footer(); ?>