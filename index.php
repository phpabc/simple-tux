<?php get_header(); ?>
  <div id="main">
  <?php if (get_option('tux_focuson')) { ?>
	 <div class="focuson">
     <ul>
     <li class="large"><a href="<?php echo stripslashes(get_option('tux_focuson_url_l')); ?>"><img src="<?php echo stripslashes(get_option('tux_focuson_imgurl_l')); ?>" style="display: inline;"><h4><?php echo stripslashes(get_option('tux_focuson_title_l')); ?></h4></a></li>
     <li><a href="<?php echo stripslashes(get_option('tux_focuson_url_s1')); ?>"><img src="<?php echo stripslashes(get_option('tux_focuson_imgurl_s1')); ?>" style="display: inline;"><h4><?php echo stripslashes(get_option('tux_focuson_title_s1')); ?></h4></a></li>
     <li><a href="<?php echo stripslashes(get_option('tux_focuson_url_s2')); ?>"><img src="<?php echo stripslashes(get_option('tux_focuson_imgurl_s2')); ?>" style="display: inline;"><h4><?php echo stripslashes(get_option('tux_focuson_title_s2')); ?></h4></a></li>
     </ul>
     </div>
<?php } ?>
	 <div id="posts">
	  <?php while ( have_posts() ) : the_post(); ?>
		<article class="post_list">
                <?php if ( has_post_thumbnail() ) { ?> <div class="thumbnail"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_post_thumbnail(); ?></a></div> <?php } ?> 	
				<header><h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>	</header>			
				<div class="excerpt">
					<div class="meta">
				    <span class="meat_span"><i class="iconfont">&#xe629;</i><?php the_author() ?></span>
					<span class="meat_span"><i class="iconfont">&#xe625;</i><?php the_category(', ') ?></span>
					<time class="meat_span"><i class="iconfont">&#xe62a;</i><?php the_time('Y-m-d'); ?></time>
					<span class="meat_span"><i class="iconfont">&#xe61f;</i><?php post_views(' ', ' 次浏览'); ?></span>					
                    <span class="meat_span meat_max"><i class="iconfont">&#xe62e;</i><?php the_tags('', ', ', ''); ?></span>
                    </div>	
                	<div class="content_text" onmouseover="this.style.cursor='pointer'" onclick="document.location='<?php the_permalink() ?>';"><?php echo mb_strimwidth(strip_tags(apply_filters('content', $post->post_content)), 0, 200,"..."); ?></div> 
				</div> 
		</article>
		<?php endwhile; ?>
		<nav class="navigation"><?php pagination($query_string); ?></nav>
	</div>
   </div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>