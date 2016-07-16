<?php
function tux_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tux_page_menu_args' );

function tux_widgets_init() {
	register_sidebar(array(
		'name' => '首页侧栏',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => '其他页侧栏',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => '内容页侧栏',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
add_action( 'widgets_init', 'tux_widgets_init' );

if ( ! function_exists( 'tux_content_nav' ) ) :

register_nav_menus(array('header-menu' => __( 'Simple Tux导航菜单' ),));

//加载小工具
include ('theme-widgets.php');

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
    <li id="li-comment-<?php comment_ID(); ?>">
    <div id="comment-<?php comment_ID(); ?>">
    	<div class="avatar"><?php echo get_avatar( $comment, 40 );?></div>
    	<div class="comment">
        	<div class="comment_meta">
            <?php printf(__('<cite>%s</cite>'), get_comment_author_link()) ?>
            <span class="time"><?php printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></span>
            <span class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '回复', 'tux' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
            <?php edit_comment_link( __( '编辑', 'tux' ), '<span class="edit_link">', '</span>' ); ?>
            </div>
            <?php comment_text(); ?>
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
	echo "<div class='pagination'>";
	echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='fir_las'>最前</a>":"";
	echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='page_previous'>« 上一页</a>":"";		
	for ($i=1; $i <= $pages; $i++){
	if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
	echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
	}
	}
	echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='page_next'>下一页 »</a>" :"";
	echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='fir_las'>最后</a>":"";
	echo "</div>\n";
	}
}

//彩色标签云定制
function colorCloud($text) {
 $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
 return $text;
}
function colorCloudCallback($matches) {
 $text = $matches[1];
 $colors = array('F99','C9C','F96','6CC','6C9','37A7FF','B0D686','E6CC6E');  
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

//移除WordPress版本号
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

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

?>
<?php
$themename = "Simple-Tux";
$shortname = "tux";
$options = array (
	array("name" => "标题（Title)",
	"id" => $shortname."_title",
	"type" => "text",
	"std" => "网站标题",
	"explain" => "SEO设置<br>它将显示在网站首页的title标签里，必填项。"
	),
	array("name" => "描述（Description）",
	"id" => $shortname."_description",
	"type" => "textarea",
	"css" => "class='h60px'",
	"std" => "网站描述",
	"explain" => "SEO设置<br>它将显示在网站首页的meta标签的description属性里"
	),
	array("name" => "关键字（KeyWords）",
	"id" => $shortname."_keywords",
	"type" => "textarea",
	"css" => "class='h60px'",
	"std" => "网站关键字",
	"explain" => "SEO设置<br>多个关键字请以英文逗号隔开，它将显示在网站首页的meta标签的keywords属性里"
	),
	array("name" => "是否显示新浪微博",
    "id" => $shortname."_weibo",
    "type" => "select",
    "std" => "隐藏",
    "options" => array("隐藏", "显示")),
	array("name" => "新浪微博地址",
    "id" => $shortname."_weibo_url",
    "type" => "text",
    "std" => "http://weibo.com/782622",
	"explain" => "请输入您的新浪微博地址"),
	array("name" => "是否显示腾讯微博",
    "id" => $shortname."_tqq",
    "type" => "select",
    "std" => "隐藏",
    "options" => array("隐藏", "显示")),
	array("name" => "腾讯微博地址",
    "id" => $shortname."_tqq_url",
    "type" => "text",
    "std" => "http://t.qq.com/tangjie",
	"explain" => "请输入您的腾讯微博地址"),
	array("name" => "版权年份",
	"id" => $shortname."_years",
	"std" => "2012",
	"type" => "text",
	"explain" => "它将显示在页面底部"
	),
	array("name" => "ICP备案号",
	"id" => $shortname."_icp",
	"type" => "text",
	"explain" => "页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的备案号，它将显示在页面底部，如果没有请留空"
	),
	array("name" => "分享代码",
	"id" => $shortname."_share",
	"type" => "textarea",
	"css" => "class='h80px'",
	"explain" => "请在此处输入您的分享代码，来自第三方或者您自己的代码，它将显示在文章的结尾处，如果没有请留空<br>第三方分享工具主要有：百度分享、JiaThis、BShare 等等"
	),
	array("name" => "统计代码",
	"id" => $shortname."_tongji",
	"type" => "textarea",
	"css" => "class='h80px'",
	"explain" => "页面底部可以显示第三方统计<br>您可以放一个或者多个统计代码"
	),
);
function mytheme_add_admin() {
    global $themename, $shortname, $options;
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
            foreach ($options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
            header("Location: themes.php?page=functions.php&saved=true");
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option( $value['id'] );
                update_option( $value['id'], $value['std'] );
            }
            header("Location: themes.php?page=functions.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." 设置", "$themename 设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_admin() {
    global $themename, $shortname, $options;
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已保存。</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 设置已重置。</strong></p></div>';
?>

<style type="text/css">
.wrap h2 {color:#09C;}
.themeadmin {border:1px dashed #999;margin-top:20px;width:420px;position:10px;}
.options {margin-top:20px;}
.options input,.options textarea {padding:2px;border:1px solid;border-color:#666 #CCC #CCC #666;background:#F9F9F9;color:#333;resize:none;width:400px;}
.options .h80px {height:80px;}
.options .h60px {height:60px;}
.options .setup {border-top:1px dotted #CCC;padding:10px 0 10px 10px;overflow:hidden;}
.options .setup h3 {font-size:14px;margin:0;padding:0;}
.options .setup .value {float:left;width:410px;}
.options .setup .explain {float:left;}
</style>
<div class="wrap">
	<h2><b>Simple-Tux主题设置</b></h2>
    <hr />
	<div>主题作者：<a href="http://www.phpabc.cn/" target="_blank">PHPABC</a> ¦ 当前版本：V1.0 ¦ 主题介绍、使用帮助及升级请访问：<a href="http://www.phpabc.cn/simple-tux.html" title="TUX" target="_blank">http://www.phpabc.cn/simple-tux.html</a></div>
<form method="post">
<div class="options">
<?php foreach ($options as $value) {
	if ($value['type'] == "text") { ?>
	<div class="setup">
		<h3><?php echo $value['name']; ?></h3>
    	<div class="value"><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?>" /></div>
    	<div class="explain"><?php echo $value['explain']; ?></div>
	</div>
	<?php } elseif ($value['type'] == "textarea") { ?>
	<div class="setup">
    	<h3><?php echo $value['name']; ?></h3>
        <div class="value"><textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" <?php echo $value['css']; ?> ><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea></div>
        <div class="explain"><?php echo $value['explain']; ?></div>
    </div>
    <?php } elseif ($value['type'] == "select") { ?>
	<div class="setup">
    	<h3><?php echo $value['name']; ?></h3>
        <div class="value">
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['option'])) {
			echo $value['option'];
		} else {
			echo $option; 
		}?></option><?php } ?>
</select>
        </div>
        <div class="explain"><?php echo $value['explain']; ?></div>
    </div>
	<?php } ?>
<?php } ?>
</div>
<div class="submit">
<input style="font-size:12px !important;" name="save" type="submit" value="保存设置" class="button-primary" />
<input type="hidden" name="action" value="save" />
</div>
</form>

<form method="post">
	<div style="margin:50px 0;border-top:1px solid #F00;padding-top:10px;">
    <input style="font-size:12px !important;" name="reset" type="submit" value="还原默认设置" />
    <input type="hidden" name="action" value="reset" />
    </div>
</form>

</div>
<?php
}
add_action('admin_menu', 'mytheme_add_admin');
?>