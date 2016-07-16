<?php get_header(); ?>
	<div id="main">
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="post_list">
			<?php if ( is_sticky() ) : ?>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			<?php else : ?>
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<div class="meta">
				    <span class="meat_span"><i class="iconfont">&#xe800;</i><?php the_author() ?></span>
					<span class="meat_span"><i class="iconfont">&#xe809;</i><?php the_category(', ') ?></span>
					<span class="meat_span"><i class="iconfont">&#xe80c;</i><?php the_time('Y-m-d'); ?></span>
					<span class="meat_span"><i class="iconfont">&#xe819;</i><?php post_views(' ', ' 次浏览'); ?></span>					
                    <span class="meat_span meat_max"><i class="iconfont">&#xe805;</i><?php the_tags('', ', ', ''); ?></span>
                </div>						
				<div class="excerpt">
					<?php if ( has_post_thumbnail() ) { ?> <div class="thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a></div> <?php } ?> 
                	<div><?php echo mb_strimwidth(strip_tags(apply_filters('content', $post->post_content)), 0, 360,"..."); ?></div>
                </div>
			<?php endif; ?>
		</div>
		<?php endwhile; ?>
		<div class="navigation"><?php pagination($query_string); ?></div>
	</div>
	<?php get_sidebar('category'); ?>
<?php get_footer(); ?>