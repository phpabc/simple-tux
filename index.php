<?php get_header(); ?>
  <div id="main">
    <div id="top-content">
	   <div class="post-rec"><a href="#"><img src="/uploads/2016/05/wp_options-2-220x146.png" alt="test" /></a></div>
	   <div class="post-rec"><a href="#"><img src="/uploads/2016/05/wp_options-2-220x146.png" alt="test" /></a></div>
	   <div class="post-rec"><a href="#"><img src="/uploads/2016/05/wp_options-2-220x146.png" alt="test" /></a></div>
	   <div class="post-rec"><a href="#"><img src="/uploads/2016/05/wp_options-2-220x146.png" alt="test" /></a></div>
	</div>
	<div id="posts">
			<?php while ( have_posts() ) : the_post(); ?>
		<div class="post_list">
			<?php if ( is_sticky() ) : ?>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<?php else : ?>
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                <?php if ( has_post_thumbnail() ) { ?> <div class="thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a></div> <?php } ?> 	
				<div class="excerpt">
					<div class="meta">
				    <span class="meat_span"><i class="iconfont">&#xe611;</i><?php the_author() ?></span>
					<span class="meat_span"><i class="iconfont">&#xe60f;</i><?php the_category(', ') ?></span>
					<span class="meat_span"><i class="iconfont">&#xe614;</i><?php the_time('Y-m-d'); ?></span>
					<span class="meat_span"><i class="iconfont">&#xe608;</i><?php post_views(' ', ' 次浏览'); ?></span>					
                    <span class="meat_span meat_max"><i class="iconfont">&#xe605;</i><?php the_tags('', ', ', ''); ?></span>
                    </div>	
                	<div class="content_text"><?php echo mb_strimwidth(strip_tags(apply_filters('content', $post->post_content)), 0, 220,"..."); ?></div>
				</div>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
		<div class="navigation"><?php pagination($query_string); ?></div>
	</div>
   </div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>