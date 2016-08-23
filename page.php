<?php get_header(); ?>
	<div id="main">
		<div id="posts">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="article">
			<h1 class="page" title="<?php the_title(); ?>"><?php the_title(); ?></h1>
			<div class="text"><?php the_content(); ?></div>
		</div>
    <div id="comments"><?php comments_template( '', true ); ?></div>
<?php endwhile; else: ?>
<?php endif; ?>
	</div></div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>