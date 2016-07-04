<?php get_header(); ?>
	<div id="main">
		<?php if ( is_day() ) : ?>
			<h1 class="h1"><?php printf( __( 'Daily: %s' ), '<span>' . get_the_date() . '</span>' ); ?></h1>
		<?php elseif ( is_month() ) : ?>
			<h1 class="h1"><?php printf( __( 'Monthly: %s' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?></h1>
		<?php elseif ( is_year() ) : ?>
			<h1 class="h1"><?php printf( __( 'Yearly: %s' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?></h1>
		<?php elseif ( is_tag() ) : ?>
			<h1 class="h1"><?php printf( __( 'Tag: %s' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="h1"><?php _e( 'Blog Archives' ); ?></h1>
		<?php endif; ?>
		
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
	<?php get_sidebar(); ?>
<?php get_footer(); ?>