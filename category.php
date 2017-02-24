<?php get_header(); ?>
	<div id="main">
		<div id="posts">
		<?php while ( have_posts() ) : the_post(); ?>
		<article class="post_list">
                <?php if ( has_post_thumbnail() ) { ?> <div class="thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a></div> <?php } ?> 	
				<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			
				<div class="excerpt">
					<div class="meta">
				    <span class="meat_span"><i class="iconfont">&#xe629;</i><?php the_author() ?></span>
					<span class="meat_span"><i class="iconfont">&#xe625;</i><?php the_category(', ') ?></span>
					<time class="meat_span"><i class="iconfont">&#xe62a;</i><?php the_time('Y-m-d'); ?></time>
					<span class="meat_span"><i class="iconfont">&#xe61f;</i><?php post_views(' ', ' 次浏览'); ?></span>					
                    <span class="meat_span meat_max"><i class="iconfont">&#xe62e;</i><?php the_tags('', ', ', ''); ?></span>
                    </div>	
                	<div class="content_text" onmouseover="this.style.cursor='pointer'" onclick="document.location='<?php the_permalink() ?>';"><?php echo mb_strimwidth(strip_tags(apply_filters('content', $post->post_content)), 0, 220,"..."); ?></div>
				</div>
		</article>
		<?php endwhile; ?>
	     </div>
		<nav class="navigation"><?php pagination($query_string); ?></nav></div>
	<?php get_sidebar('category'); ?>
<?php get_footer(); ?>