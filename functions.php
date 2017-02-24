<?php
//加载小工具
include ('inc/theme-widgets.php');
//加载主题后台配置
include ('inc/theme-options.php');

function tux_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tux_page_menu_args' );

function tux_widgets_init() {
	register_sidebar(array(
		'name' => '首页侧栏',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => '其他页侧栏',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => '内容页侧栏',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'tux_widgets_init' );

if ( ! function_exists( 'tux_content_nav' ) ) :

register_nav_menus(array('header-menu' => __( 'Simple Tux导航菜单' ),));


//文章浏览次数统计
function record_visitors()
{
	if (is_singular())
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID)
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1)))
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'record_visitors');
 
function post_views($before = '(点击 ', $after = ' 次浏览)', $echo = 1)
{
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  if ($echo) echo $before, number_format($views), $after;
  else return $views;
}


//取得阅读最多的文章
function tux_most_viewed($mode = '', $limit = 10, $show_date = 0, $term_id = 0, $beforetitle= '<a href=', $aftertitle = '</a>', $beforedate= '', $afterdate = '', $beforecount= '', $aftercount = '') {
  global $wpdb, $post;
  $output = '';
  $mode = ($mode == '') ? 'post' : $mode;
  $type_sql = ($mode != 'both') ? "AND post_type='$mode'" : '';
  $term_sql = (is_array($term_id)) ? "AND $wpdb->term_taxonomy.term_id IN (" . join(',', $term_id) . ')' : ($term_id != 0 ? "AND $wpdb->term_taxonomy.term_id = $term_id" : '');
  $term_sql.= $term_id ? " AND $wpdb->term_taxonomy.taxonomy != 'link_category'" : '';
  $inr_join = $term_id ? "INNER JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id) INNER JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)" : '';

  // database query
  $most_viewed = $wpdb->get_results("SELECT post_title, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) $inr_join WHERE post_status = 'publish' AND post_password = '' $term_sql $type_sql AND meta_key = 'views' GROUP BY ID ORDER BY views DESC LIMIT $limit");
  if ($most_viewed) {
   foreach ($most_viewed as $viewed) {
    $post_views = number_format($viewed->views);
    $post_title = esc_attr($viewed->post_title);
    $get_permalink = esc_attr(get_permalink());
    $output .= "<li>$beforetitle$get_permalink> $post_title$aftertitle</li>";
   }   
  } else {
   $output = "<li>N/A</li>\n";
  }
  echo $output;
}

// 获得热评文章
function tux_get_most_commented ($posts_num=10, $days=360){
    global $wpdb;
    $sql = "SELECT post_title , comment_count FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' ) ORDER BY comment_count DESC LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink()."\" title=\"".$post->post_title."\" >".$post->post_title."</a></li>";
    }
    echo $output;
}

//随机文章
function tux_rand_posts ($posts_num=10, $days=360){
    global $wpdb;
    $sql = "SELECT post_title FROM $wpdb->posts WHERE post_type = 'post' AND TO_DAYS(now()) - TO_DAYS(post_date) < $days AND ($wpdb->posts.`post_status` = 'publish' ) ORDER BY rand() LIMIT 0 , $posts_num ";
    $posts = $wpdb->get_results($sql);
    $output = "";
    foreach ($posts as $post){
        $output .= "\n<li><a href= \"".get_permalink()."\" title=\"".$post->post_title."\" >".$post->post_title."</a></li>";
    }
    echo $output;
}

//禁止wordpress加载google字体
function coolwp_remove_open_sans_from_wp_core() {
wp_deregister_style( 'open-sans' );   
wp_register_style( 'open-sans', false );   
wp_enqueue_style('open-sans','');}
add_action( 'init', 'coolwp_remove_open_sans_from_wp_core' );

//多说缓存头像
function tux_get_avatar($avatar) {
$avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);
return $avatar;
}
add_filter( 'get_avatar', 'tux_get_avatar', 10, 3 );

//评论模板
function tux_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'tux' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'tux' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
    <li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?> >
    <div id="comment-<?php comment_ID(); ?>" class="mycomment">
    	<div class="comment-s">
        	<div class="comment_meta">
            <?php printf(__('<cite>%s</cite>'), get_comment_author_link()) ?>
            <span class="time"><?php printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></span>
            <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '回复', 'tux' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
            <?php edit_comment_link( __( '编辑', 'tux' ), '<span class="edit_link">', '</span>' ); ?>
            </div>
			<div class="comment_text"><?php comment_text(); ?></div>
            <?php if ( '0' == $comment->comment_approved ) : ?><p style="color:#F00;"><?php _e( '您的评论正在等待审核。', 'tux' ); ?></p><?php endif; ?>
        </div>
    </div>
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

//分页
function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;							
$next = $paged + 1;	
$range = 5; // 分页数设置
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
	echo "<ul class='pagination'>";
	echo ($paged > 1 && $showitems < $pages)? "<li class='pre_nxt'><a href='".get_pagenum_link($prev)."' class='page_previous'> « </a></li>":"";		
	for ($i=1; $i <= $pages; $i++){
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>"; 
	}
	}
	echo ($paged < $pages && $showitems < $pages) ? "<li class='pre_nxt'><a href='".get_pagenum_link($next)."' class='page_next'> » </a></li>" :"";
	echo "</ul>\n";
	}
}

//彩色标签云定制
function colorCloud($text) {
 $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
 return $text;
}
function colorCloudCallback($matches) {
 $text = $matches[1];
 $colors = array('428BCA','D9534F','567E95','4A4A4A','6E8B3D','B37333','B433FF','5CB85C');  
 $color=$colors[dechex(rand(0,7))];  $pattern = '/style=(\'|\")(.*)(\'|\")/i';
 $text = preg_replace($pattern, "style=\"color:#{$color};$2;border: 1px solid #{$color};padding: 4px 6px;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;margin-right:4px;\"", $text);
 return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);

add_filter( 'widget_tag_cloud_args', 'theme_tag_cloud_args' );
function theme_tag_cloud_args( $args ){
	$newargs = array(
		'smallest'    => 14,  //最小字号
		'largest'     => 14, //最大字号
		'unit'        => 'px',   //字号单位，可以是pt、px、em或%
		'number'      => 26,     //显示个数
		'format'      => 'flat',//列表格式，可以是flat、list或array
		'separator'   => "\n",   //分隔每一项的分隔符
		'orderby'     => 'count',//排序字段，可以是name或count
		'order'       => 'rand', //升序或降序，ASC或DESC
		'exclude'     => null,   //结果中排除某些标签
		'include'     => null,  //结果中只包含这些标签
		'link'        => 'view', //taxonomy链接，view或edit
		'taxonomy'    => 'post_tag', //调用哪些分类法作为标签云
	);
	$return = array_merge( $args, $newargs);
	return $return;
}

//新窗口打开评论里的链接
function remove_comment_links() {
global $comment;
$url = get_comment_author_url();
$author = get_comment_author();
if ( empty( $url ) || 'http://' == $url )
$return = $author;
else
$return = "<a href='$url' rel='external nofollow' target='_blank'>$author</a>";
return $return;
}
add_filter('get_comment_author_link', 'remove_comment_links');
remove_filter('comment_text', 'make_clickable', 9);

//文章缩略图
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 220, 140 );
function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);//用正则过滤文章
	$first_img = $matches [1] [0];
	if(empty($first_img)){
		$first_img = '';//第一张图片为空，也可以为一个默认地址。
	}
	return $first_img;
}

//添加编辑器快捷按钮
add_action('admin_print_scripts', 'my_quicktags');
function my_quicktags() {
    wp_enqueue_script(
        'my_quicktags',
        get_stylesheet_directory_uri().'/js/my_quicktags.js',
        array('quicktags')
    );
    }; 

// 评论回应邮件通知
function comment_mail_notify($comment_id) {
  $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
  $comment = get_comment($comment_id);
  $comment_author_email = trim($comment->comment_author_email);
  $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
  $to = $parent_id ? trim(get_comment($parent_id)->comment_author_email) : '';
  $spam_confirmed = $comment->comment_approved;
  if (($parent_id != '') && ($spam_confirmed != 'spam') && ($to != $admin_email) && ($comment_author_email == $admin_email)) {
    $wp_email = 'no-reply@phpabc.cn' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // no-reply 可改为可用的 e-mail.
    $subject = '您在 [' . get_option("blogname") . '] 的评论有新的回复';
    $message = '
    <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
      <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
      <p>您曾在 [' . get_option("blogname") . '] 的文章 《' . get_the_title($comment->comment_post_ID) . '》 上发表评论:<br />'
       . nl2br(get_comment($parent_id)->comment_content) . '</p>
      <p>' . trim($comment->comment_author) . ' 给您的回复如下:<br />'
       . nl2br($comment->comment_content) . '<br /></p>
      <p>您可以点击 <a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">查看回复的完整內容</a></p>
      <p>欢迎再次光临 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
      <p>(此邮件由系统自动发出,请勿直接回复.)</p>
    </div>';
	$message = convert_smilies($message);
    $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
    $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
    wp_mail( $to, $subject, $message, $headers );
    //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
  }
}
add_action('comment_post', 'comment_mail_notify');
//移除wp-head 多余代码
    remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
    remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
    remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
    remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
    remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
    remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
    remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
    remove_action( 'wp_head', 'noindex', 1 );
    remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
    remove_action( 'wp_head', 'rel_canonical' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
    remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
//禁用embeds	
		function disable_emojis() {  
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );  
remove_action( 'wp_print_styles', 'print_emoji_styles' );  
remove_action( 'admin_print_styles', 'print_emoji_styles' );  
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );  
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );  
add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );  
}  
add_action( 'init', 'disable_emojis' );  
/** 
* Filter function used to remove the tinymce emoji plugin. 
*/  
function disable_emojis_tinymce( $plugins ) {  
if ( is_array( $plugins ) ) {  
return array_diff( $plugins, array( 'wpemoji' ) );  
} else {  
return array();  
}  
}  
   
function disable_embeds_init() {  
global $wp;  
$wp->public_query_vars = array_diff( $wp->public_query_vars, array( 'embed', ) );  
remove_action( 'rest_api_init', 'wp_oembed_register_route' );  
add_filter( 'embed_oembed_discover', '__return_false' );  
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );  
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );  
remove_action( 'wp_head', 'wp_oembed_add_host_js' );  
add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );  
add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); }  
add_action( 'init', 'disable_embeds_init', 9999 );  
function disable_embeds_tiny_mce_plugin( $plugins ) { return array_diff( $plugins, array( 'wpembed' ) ); }  
function disable_embeds_rewrites( $rules ) { foreach ( $rules as $rule => $rewrite ) { if ( false !== strpos( $rewrite, 'embed=true' ) ) { unset( $rules[ $rule ] ); } }  
return $rules; }  
function disable_embeds_remove_rewrite_rules() { add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); flush_rewrite_rules(); }  
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );  
function disable_embeds_flush_rewrite_rules() { remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ); flush_rewrite_rules(); }  
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );  

?>
