<h3><span class="selected">最新日志</span><span>热评日志</span><span>随机日志</span></h3>
    <div id="tab-content">
       <ul>
		<?php $myposts = get_posts('numberposts=10&offset=0');foreach($myposts as $post): ?>
         <li><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title_attribute(); ?>"><?php echo cut_str($post->post_title,30); ?></a></li>
        <?php endforeach; ?>
	</ul>
    <ul class="hide">
		<?php tux_get_most_commented (); ?>
    </ul>
    <ul class="hide">
		<?php $rand_posts = get_posts('numberposts=10&orderby=rand');  foreach( $rand_posts as $post ) : ?>
    	<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
    	<?php endforeach; ?>
	</ul>
    </div>