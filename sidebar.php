<div id="sidebar">
    <div class="sidebar">
    <?php
     if (is_single()){
	  if (function_exists('dynamic_sidebar') && dynamic_sidebar('内容页侧栏')) : endif;
      }
     else if (is_home()){
	  if (function_exists('dynamic_sidebar') && dynamic_sidebar('首页侧栏')) : endif;
      }
     else {
	  if (function_exists('dynamic_sidebar') && dynamic_sidebar('其他页侧栏')) : endif;
      }
     ?>
    </div>
</div>
