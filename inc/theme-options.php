<?php
$options = array(
    //开始第一个选项标签数组
    array(
        'title' => '基本配置',//标签显示的文字
        'id'    => 'panel_general',//标签的ID
        'type'  => 'panelstart' //顶部标签的类型
    ),
	array(
        'name'  => '标题（Title)',
        'desc'  => '它将显示在网站首页的title标签里，必填项。',
        'id'    => 'tux_title',
        'type'  => 'text',
        'std'   => '网站标题'
    ),
		array(
        'name'  => '关键字（KeyWords）',
        'desc'  => '多个关键字请以英文逗号隔开，它将显示在网站首页的meta标签的keywords属性里',
        'id'    => 'tux_keywords',
        'type'  => 'text',
        'std'   => '关键字（KeyWords）'
    ),
		array(
        'name'  => '描述（Description）)',
        'desc'  => '它将显示在网站首页的meta标签的description属性里。',
        'id'    => 'tux_description',
        'type'  => 'textarea',
        'std'   => '网站描述'
    ),	
		array(
        'name'  => 'ICP 备案号',
        'desc'  => '页面底部可以显示 ICP 备案信息，如果网站已备案，在此输入您的备案号</br>它将显示在页面底部,如果没有请留空',
        'id'    => 'tux_icp',
        'type'  => 'text',
        'std'   => ''
    ),	
		array(
        'name'  => 'ICP 备案号',
        'desc'  => '建站起始年份,底部版权申明出展示',
        'id'    => 'tux_years',
        'type'  => 'text',
        'std'   => '2016'
    ),			
	   array(
     	'name' => '头部Head 区代码',
    	'id'   => 'tux_head_code',
    	'type' => 'textarea',
	    'desc' => 'Head 区代码，如添加meta信息验证网站所有权。'
	),
    	array(
		'name' => '统计代码',
    	'id'   => 'tux_tongji',
    	'type' => 'textarea',
     	'desc' => '页面底部可以显示第三方统计，可以放一个或者多个统计代码'
	),	
    array(
        'type'  => 'panelend'
    ),
//开始第二个选项标签数组
    array(
        'title' => '扩展配置',
        'id'    => 'panel_adsense',
        'type'  => 'panelstart'
    ),
    array(
        'name'  => '分享代码',
        'desc'  => '此处输入您的分享代码，来自第三方或者您自己的代码，它将显示在文章的右下角，如果没有请留空<br>第三方分享工具主要有：百度分享、JiaThis、BShare 等等',
        'id'    => 'tux_share',
        'type'  => 'textarea',
        'std'   => '<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a><a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a><a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a><a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a><a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a></div>'
    ),
    array(
        'name'  => '文章页底部广告',
        'desc'  => '是否打开文章底部广告',
        'id'    => 'tux_content_ad',
        'type'  => 'radio',
        'options' => array(
            '显示' => 'tux_content_ad_1',
            '隐藏' => 'tux_content_ad_0',),
        'std'   => 'tux_content_ad_0'
    ),	
    array(
        'name'  => '文章页底部广告',
        'desc'  => '文章页底部广告',
        'id'    => 'tux_content_adcode',
        'type'  => 'textarea',
        'std'   => ''
    ),	
    array(
        'type'  => 'panelend'
    ),
//开始第三个选项标签数组
    array(
        'title' => '社交设置',
        'id'    => 'panel_social',
        'type'  => 'panelstart'
    ),
    array(
        'title' => '社交小图标，空置默认为不启用，建议别超过六个',
        'type'  => 'subtitle'
    ),
    array(
        'name'  => 'RSS订阅地址',
        'desc'  => '如果您想使用自定义的RSS地址，请在这里输入您期望的地址。',
        'id'    => 'tux_rss',
        'type'  => 'text',
        'std'   => get_bloginfo('rss2_url')
    ),
    array(
        'name'  => '新浪微博',
        'desc'  => '填写新浪微博个人主页链接',
        'id'    => 'tux_weibo',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '腾讯微博',
        'desc'  => '填写腾讯微博个人主页链接',
        'id'    => 'tux_tqq',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '腾讯微信',
        'desc'  => '输入您的微信号,配合微信二维码一起使用',
        'id'    => 'tux_weixin',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '微信二维码',
        'desc'  => '输入您的二维码图片路径',
        'id'    => 'tux_weixin_qr',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '腾讯QQ',
        'desc'  => '直接输入QQ号即可',
        'id'    => 'tux_qqContact',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'Google +',
        'desc'  => 'Gpogle +地址',
        'id'    => 'tux_google',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '百度贴吧',
        'desc'  => '百度帖吧地址',
        'id'    => 'tux_baidu',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '支付宝',
        'desc'  => '输入支付宝帐号，配合支付宝二维码一起使用',
        'id'    => 'tux_pay',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => '支付宝二维码',
        'desc'  => '请输入您的支付宝图片路径',
        'id'    => 'tux_pay_qr',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'GitHub',
        'desc'  => 'GitHub 主页地址',
        'id'    => 'tux_github',
        'type'  => 'text',
        'std'   => ''
    ),
    array(
        'name'  => 'Facebook',
        'desc'  => 'Facebook 主页地址',
        'id'    => 'tux_facebook',
        'type'  => 'text',
        'std'   => ''
    ),	
    array(
        'name'  => 'Twitter',
        'desc'  => 'Twitter 主页地址',
        'id'    => 'tux_twitter',
        'type'  => 'text',
        'std'   => ''
    ),	
    array(
        'name'  => '领英',
        'desc'  => 'Linkedin 主页地址',
        'id'    => 'tux_linkedin',
        'type'  => 'text',
        'std'   => ''
    ),		
    array(
        'type'  => 'panelend'
    ),
//标签段的结束		
	/*关闭多余选项卡备用
    array(
        'title' => '选项一',//标签显示的文字
        'id'    => 'panel_general',//标签的ID
        'type'  => 'panelstart' //顶部标签的类型
    ),
	array(
        'name'  => '数字选择框',
        'desc'  => '这个是数字输入框',
        'id'    => 'tux_linkpage_cat',
        'type'  => 'number',
        'std'   => '2'//最后一个数组不需要逗号
    ),
	array(
        'name'  => '选择选项',
        'desc'  => '勾选选项的描述文字',
        'id'    => 'tux_thumbnail_b',
        'type'  => 'checkbox'//复选框
    ),
	array(
        'name'  => '单选项设置',
        'desc'  => '选择一个参数作为排序的根据，可以给与几个选择并且选择一个，可以预留选项',
        'id'    => 'tux_hot_b',
        'type'  => 'radio',
        'options' => array(
            '选择一' => 'xuanze1',
            '选择二' => 'xuanze2',
			'选择三' => 'xuanze3',
			'选择四' => 'xuanze4',
			'选择五' => 'xuanze5',
			'选择六' => 'xuanze6',
			'选择七' => 'xuanze7',
            '选择八' => 'xuanze8'
        ),
        'std'   => 'xuanze1'
    ),
	array(
        'name'  => '复选项设置',
        'desc'  => '',
        'id'    => 'tux_hot_b4',
        'type'  => 'checkboxs',
        'options' => array(
            'xuanze14' => '选择一',
			'xuanze24' => '选择二',
			'xuanze34' => '选择三',
			'xuanze44' => '选择四',
			'xuanze54' => '选择五'
        ),
        'std'   => 'xuanze14'
    ),
	array(
        'name'  => '单选项设置',
        'desc'  => '选择一个参数作为排序的根据，可以给与几个选择并且选择一个，可以预留选项',
        'id'    => 'tux_hot_b5',
        'type'  => 'select',
        'options' => array(
            'xuanze12' => '选择一',
			'xuanze22' => '选择二',
			'xuanze32' => '选择三',
			'xuanze42' => '选择四',
			'xuanze52' => '选择五'
        ),
        'std'   => 'xuanze52'
    ),
	array(
        'name'  => '密码选项输入框',
        'desc'  => '这是一个密码输入框，所以不可见',
        'id'    => 'tux_wbpasd_b',
        'type'  => 'password',
        'std'   => ''
    ),
    array(
        'title' => '这是一个分段，也是一个二级标题',//二级标题，只显示文字，没有选项
        'type'  => 'subtitle'//二级标题的类型
    ),
    array(
        'name'  => '文字选项',
        'desc'  => '这里是输入框的描述文字',
        'id'    => 'hot_list_title',
        'type'  => 'text',
        'std'   => '主题预留文字'
    ),
    array(
        'name'  => '文本框选项',
        'desc'  => '这里是输入框的描述文字',//这里可以随便写的
        'id'    => '’tux_tui',//ID是保存数据的值，保持唯一性
        'type'  => 'textarea',//设置选项的类型
        'std'   => '这里是选项的默认数据'//选项的默认数据
    ),
    array(
        'name'  => '文字选项设置',
        'desc'  => '选项的描述文字',
        'id'    => 'tux_tougao_mailto',
        'type'  => 'text',
        'std'   => get_bloginfo( 'admin_email' ) //亮点是默认值里面可以用函数调用
    ),
    array(
        'type'  => 'panelend'//标签段的结束
    ),
    */
);
//主题后台设置已完成，下面可以不用看了
function tux_add_theme_options_page() {
    global $options;
    if ($_GET['page'] == basename(__FILE__)) {
        if ('update' == $_REQUEST['action']) {
            foreach($options as $value) {
                if (isset($_REQUEST[$value['id']])) {
                    update_option($value['id'], $_REQUEST[$value['id']]);
                } else {
                    delete_option($value['id']);
                }
            }
            update_option('tux_options_setup', true);
            header('Location: themes.php?page=theme-options.php&update=true');
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
            foreach ($options as $value) {
                delete_option($value['id']);
            }
            delete_option('tux_options_setup');
            header('Location: themes.php?page=theme-options.php&reset=true');
            die;
        }
    }
    add_theme_page('Simple Tux 主题选项', 'Simple Tux 主题选项', 'edit_theme_options', basename(__FILE__) , 'tux_options_page');
}
add_action('admin_menu', 'tux_add_theme_options_page');

function tux_options_page() {
    global $options;
    $optionsSetup = get_option('tux_options_setup') != '';
    if ($_REQUEST['update']) echo '<div class="updated"><p><strong>设置已保存。</strong></p></div>';
    if ($_REQUEST['reset']) echo '<div class="updated"><p><strong>设置已重置。</strong></p></div>';
?>

<div class="wrap">
    <h2>Simple Tux 主题选项</h2>
	<p>主题作者：<a href="http://www.phpabc.cn/" target="_blank">PHPABC</a> ¦ 当前版本：V1.1</br>
	主题介绍、使用帮助及升级请访问：<a href="http://www.phpabc.cn/simple-tux.html" title="TUX" target="_blank">http://www.phpabc.cn/simple-tux.html</a>
	</p>
    <input placeholder="搜索主题选项…" type="search" id="theme-options-search" />
    <form method="post">
        <h2 class="nav-tab-wrapper">
<?php
$panelIndex = 0;
foreach ($options as $value ) {
    if ( $value['type'] == 'panelstart' ) echo '<a href="#' . $value['id'] . '" class="nav-tab' . ( $panelIndex == 0 ? ' nav-tab-active' : '' ) . '">' . $value['title'] . '</a>';
    $panelIndex++;
}
echo '<a href="#about_theme" class="nav-tab">关于主题</a>';

?>
</h2>
<!-- 开始建立选项类型 -->
<?php
$panelIndex = 0;
foreach ($options as $value) {
switch ( $value['type'] ) {
    case 'panelstart'://最高标签
        echo '<div class="panel" id="' . $value['id'] . '" ' . ( $panelIndex == 0 ? ' style="display:block"' : '' ) . '><table class="form-table">';
        $panelIndex++;
        break;
    case 'panelend':
        echo '</table></div>';
        break;
    case 'subtitle':
        echo '<tr><th colspan="2"><h3>' . $value['title'] . '</h3></th></tr>';
        break;
    case 'text':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type='text' value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'number':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="small-text" id="<?php echo $value['id']; ?>" type="number" value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'password':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
        <input name="<?php echo $value['id']; ?>" class="regular-text" id="<?php echo $value['id']; ?>" type="password" value="<?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" />
        <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>
<?php
    break;
    case 'textarea':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <p><label for="<?php echo $value['id']; ?>"><?php echo $value['desc']; ?></label></p>
        <p><textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" rows="5" cols="50" class="large-text code"><?php if ( $optionsSetup || get_option( $value['id'] ) != '') { echo stripslashes(get_option( $value['id'] )); } else { echo $value['std']; } ?></textarea></p>
    </td>
</tr>
<?php
    break;
    case 'select':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <label>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) : ?>
                <option value="<?php echo $option; ?>" <?php selected( get_option( $value['id'] ), $option); ?>>
                    <?php echo $option; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <span class="description"><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'radio':
?>
<tr>
    <th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></th>
    <td>
        <?php foreach ($value['options'] as $name => $option) : ?>
        <label>
            <input type="radio" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="<?php echo $option; ?>" <?php checked( get_option( $value['id'] ), $option); ?>>
            <?php echo $name; ?>
        </label>
        <?php endforeach; ?>
        <p><span class="description"><?php echo $value['desc']; ?></span></p>
    </td>
</tr>
 
<?php
    break;
    case 'checkbox':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <label>
            <input type='checkbox' name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="1" <?php echo checked(get_option($value['id']), 1); ?> />
            <span><?php echo $value['desc']; ?></span>
        </label>
    </td>
</tr>

<?php
    break;
    case 'checkboxs':
?>
<tr>
    <th><?php echo $value['name']; ?></th>
    <td>
        <?php $checkboxsValue = get_option( $value['id'] );
        if ( !is_array($checkboxsValue) ) $checkboxsValue = array();
        foreach ( $value['options'] as $id => $title ) : ?>
        <label>
            <input type="checkbox" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>[]" value="<?php echo $id; ?>" <?php checked( in_array($id, $checkboxsValue), true); ?>>
            <?php echo $title; ?>
        </label>
        <?php endforeach; ?>
        <span class="description"><?php echo $value['desc']; ?></span>
    </td>
</tr>
<?php
    break;
}
}
?>
<!-- 结束建立选项类型 -->
<div class="panel" id="about_theme">
<h2>关于主题</h2>
    <p>主题作者：<a href="http://www.phpabc.cn/" target="_blank">PHPABC</a> ¦ 当前版本：V1.1</br>
	主题介绍、使用帮助及升级请访问：<a href="http://www.phpabc.cn/simple-tux.html" title="TUX" target="_blank">http://www.phpabc.cn/simple-tux.html</a>
	</p>
</div>
<p class="submit">
    <input name="submit" type="submit" class="button button-primary" value="保存选项"/>
    <input type="hidden" name="action" value="update" />
</p>
</form>
<form method="post">
<p>
    <input name="reset" type="submit" class="button button-secondary" value="重置选项" onclick="return confirm('你确定要重置选项吗？重置之后您的全部设置将被清空，您确定您没有搞错？？ ');"/>
    <input type="hidden" name="action" value="reset" />
</p>
</form>
</div>
<style>.catlist{border:2px solid #FFB6C1;padding:5px;margin-top: 12px;text-align: center;color:#000;}.panel{display:none}.panel h3{margin:0;font-size:1.2em}#panel_update ul{list-style-type:disc}.nav-tab-wrapper{clear:both}.nav-tab{position:relative}.nav-tab i:before{position:absolute;top:-10px;right:-8px;display:inline-block;padding:2px;border-radius:50%;background:#e14d43;color:#fff;content:"\f463";vertical-align:text-bottom;font:400 18px/1 dashicons;speak:none}#theme-options-search{display:none;float:right;margin-top:-34px;width:280px;font-weight:300;font-size:16px;line-height:1.5}.updated+#theme-options-search{margin-top:-91px}.wrap.searching .nav-tab-wrapper a,.wrap.searching .panel tr,#attrselector{display:none}.wrap.searching .panel{display:block !important}#attrselector[attrselector*=ok]{display:block}</style>
<style id="theme-options-filter"></style>
<div id="attrselector" attrselector="ok" ></div>
<script>
jQuery(function ($) {
    $(".nav-tab").click(function () {
        $(this).addClass("nav-tab-active").siblings().removeClass("nav-tab-active");
        $(".panel").hide();
        $($(this).attr("href")).show();
        return false;
    });

    var themeOptionsFilter = $("#theme-options-filter");
    themeOptionsFilter.text("ok");
    if ($("#attrselector").is(":visible") && themeOptionsFilter.text() != "") {
        $(".panel tr").each(function (el) {
            $(this).attr("data-searchtext", $(this).text().replace(/\r|\n/g, '').replace(/ +/g, ' ').toLowerCase());
        });

        var wrap = $(".wrap");
        $("#theme-options-search").show().on("input propertychange", function () {
            var text = $(this).val().replace(/^ +| +$/, "").toLowerCase();
            if (text != "") {
                wrap.addClass("searching");
                themeOptionsFilter.text(".wrap.searching .panel tr[data-searchtext*='" + text + "']{display:block}");
            } else {
                wrap.removeClass("searching");
                themeOptionsFilter.text("");
            };
        });
    };
});
</script>
<?php
}
//启用主题后自动跳转至选项页面
global $pagenow;
    if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' )
    {
        wp_redirect( admin_url( 'themes.php?page=theme-options.php' ) );
    exit;
}
function tux_enqueue_pointer_script_style( $hook_suffix ) {
    $enqueue_pointer_script_style = false;
    $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    if( !in_array( 'tux_options_pointer', $dismissed_pointers ) ) {
        $enqueue_pointer_script_style = true;
        add_action( 'admin_print_footer_scripts', 'tux_pointer_print_scripts' );
    }
    if( $enqueue_pointer_script_style ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    }
}
add_action( 'admin_enqueue_scripts', 'tux_enqueue_pointer_script_style' );
function tux_pointer_print_scripts() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        var $menuAppearance = $("#menu-appearance");
        $menuAppearance.pointer({
            content: '<h3>恭喜，您的主题安装成功！</h3><p>Simple Tux主题支持选项，请访问<a href="themes.php?page=theme-options.php">主题选项</a>页面进行配置。</p>',
            position: {
                edge: "left",
                align: "center"
            },
            close: function() {
                $.post(ajaxurl, {
                    pointer: "tux_options_pointer",
                    action: "dismiss-wp-pointer"
                });
            }
        }).pointer("open").pointer("widget").find("a").eq(0).click(function() {
            var href = $(this).attr("href");
            $menuAppearance.pointer("close");
            setTimeout(function(){
                location.href = href;
            }, 700);
            return false;
        });

        $(window).on("resize scroll", function() {
            $menuAppearance.pointer("reposition");
        });
        $("#collapse-menu").click(function() {
            $menuAppearance.pointer("reposition");
        });
    });
    </script>

<?php
}