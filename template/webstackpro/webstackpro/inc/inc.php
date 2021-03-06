<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
# 注册侧边栏
# --------------------------------------------------------------------
if (function_exists('register_sidebar')){

	register_sidebar( array(
		'name'          => '博客布局侧边栏',
		'id'            => 'sidebar-h',
		'description'   => '显示在首页博客布局侧边栏',
		'before_widget' => '<div id="%1$s" class="card %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header widget-header"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => '正文侧边栏',
		'id'            => 'sidebar-s',
		'description'   => '显示在文章正文及页面侧边栏',
		'before_widget' => '<div id="%1$s" class="card %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header widget-header"><span>',
		'after_title'   => '</span></div>',
	) );

	register_sidebar( array(
		'name'          => '分类归档侧边栏',
		'id'            => 'sidebar-a',
		'description'   => '显示在文章归档页、搜索、404页侧边栏 ',
		'before_widget' => '<div id="%1$s" class="card %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header widget-header"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => '公告归档页侧边栏',
		'id'            => 'sidebar-bull',
		'description'   => '显示在公告归档页侧边栏',
		'before_widget' => '<div id="%1$s" class="card %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="card-header widget-header"><span>',
		'after_title'   => '</span></div>',
	) );

}
# 注册菜单
# --------------------------------------------------------------------
register_nav_menus( array(
	'nav_main'    => __( '侧栏菜单' , 'i_owen' ),
    'main_menu'   => __( '顶部菜单' , 'i_owen' ),
    'search_menu' => __( '搜索推荐' , 'i_owen' ),
));
# 添加菜单
# --------------------------------------------------------------------
function wp_menu($location){
    if ( function_exists( 'wp_nav_menu' ) && has_nav_menu($location) ) {
        wp_nav_menu( array( 'container' => false, 'items_wrap' => '%3$s', 'theme_location' => $location ) );
    } else {
        if($location == 'search_menu')
            echo '<li><a href="'.get_bloginfo('url').'/wp-admin/nav-menus.php">请到[后台->外观->菜单]中添加“搜索推荐”菜单。</a></li>';
        else
            echo '<li><a href="'.get_bloginfo('url').'/wp-admin/nav-menus.php">请到[后台->外观->菜单]中设置菜单。</a></li>';
    }
}
# 激活友情链接模块
# --------------------------------------------------------------------
if(io_get_option('show_friendlink'))add_filter( 'pre_option_link_manager_enabled', '__return_true' );
# 引用功能
# --------------------------------------------------------------------
require_once get_theme_file_path() . '/inc/framework/framework.php';
require_once get_theme_file_path() . '/inc/theme-settings.php';
require_once get_theme_file_path() . '/inc/wp-optimization.php';
require_once get_theme_file_path() . '/inc/register.php';
require_once get_theme_file_path() . '/inc/post-type.php';
require_once get_theme_file_path() . '/inc/fav-content.php';
require_once get_theme_file_path() . '/inc/meta-boxs.php';
require_once get_theme_file_path() . '/inc/meta-taxonomy.php';
require_once get_theme_file_path() . '/inc/ajax.php';
require_once get_theme_file_path() . '/inc/clipimage.php';
require_once get_theme_file_path() . '/inc/widgets.php';
require_once get_theme_file_path() . '/inc/shortcode.php';
if(io_get_option('save_image')) require_once get_theme_file_path() . '/inc/save-image.php';
if(io_get_option('post_views')) require_once get_theme_file_path() . '/inc/postviews/postviews.php';
# 获取CSF框架设置（兼容1.0）
# --------------------------------------------------------------------
function io_get_option($option, $default = null){
    $options = get_option('io_get_option');
    return ( isset( $options[$option] ) ) ? $options[$option] : $default;
}
# 获取CSF框架图片
# --------------------------------------------------------------------
function get_post_meta_img($post_id, $key, $single){
    $metas = get_post_meta($post_id, $key, $single);
    if(is_array($metas)){
        return $metas['url'];
    } else {
        return $metas;
    }
}
# 网站块类型（兼容1.0）
# --------------------------------------------------------------------
function before_class($post_id){
    $metas      = get_post_meta_img($post_id, '_wechat_qr', true);
    $sites_type = get_post_meta($post_id, '_sites_type', true);
    if($metas != '' || $sites_type == "wechat"){
        return 'wechat';
    } elseif($sites_type == "down") {
        return 'down';
    } else {
        return '';
    }
}
# 主题切换
# --------------------------------------------------------------------
function theme_mode(){
    $default_c = io_get_option('theme_mode');
    if($default_c == 'io-black-mode')
        $default_c = '';
    if ($_COOKIE['night_mode'] != '') {
        return(trim($_COOKIE['night_mode']) == '0' ? 'io-black-mode' : $default_c); 
    } elseif (io_get_option('theme_mode')) {
        return io_get_option('theme_mode');
    } else { 
        return(trim($_COOKIE['night_mode']) == '0' ? 'io-black-mode' : $default_c); 
    }
}
# 新窗口访问
# --------------------------------------------------------------------
function new_window(){
    if(io_get_option('new_window'))
        return 'target="_blank"';
    else
        return '';
}
# 验证网址状态
# --------------------------------------------------------------------
function security_check($url){
    if(io_get_option('show_speed'))
        echo'<img class="security_check d-none" data-ip="'.gethostbyname(format_url($url)).'" src="//'. format_url($url) .'/'.mt_rand().'.png' . '" width=1 height=1  onerror=check("'. $url .'")>';
}
# 后台检测网址状态
# --------------------------------------------------------------------
add_action('admin_bar_menu', 'invalid_prompt_menu', 1000);
function invalid_prompt_menu() {
    $n =io_get_option('failure_valve');
    if($n != 0){
        global $wp_admin_bar;
        $menu_id = 'invalid';
        $args = array(
            'post_type' => 'sites',// 文章类型
            'post_status' => 'publish',
            'meta_key' => 'invalid', 
            'meta_type' => 'NUMERIC', 
            'meta_value' => $n,
            'meta_compare' => '>'
        );
        $invalid_items = new WP_Query( $args ); 
        if ($invalid_items->have_posts()) : 
            $wp_admin_bar->add_menu(array(
                'id' => $menu_id,  
                'title' => '<span class="update-plugins count-2" style="display: inline-block;background-color: #d54e21;color: #fff;font-size: 9px;font-weight: 600;border-radius: 10px;z-index: 26;height: 18px;margin-right: 5px;"><span class="update-count" style="display: block;padding: 0 6px;line-height: 17px;">'.$invalid_items->found_posts.'</span></span>个网址可能失效', 
                'href' => get_bloginfo('url')."/wp-admin/index.php"
            ));
        endif; 
        wp_reset_query();
    }
}
# 网址状态面板
# --------------------------------------------------------------------
if( is_admin() && io_get_option('failure_valve')!=0 ){
    add_action('wp_dashboard_setup', 'example_add_invalid_widgets' ); 
    function example_add_invalid_widgets() {
        wp_add_dashboard_widget('custom_invalid_help', '网址状态', 'custom_invalid_help');
    }
    function custom_invalid_help() {
        echo '<p><i class="dashicons-before dashicons-admin-site"></i> <span>网站收录了 '.wp_count_posts('sites')->publish.' 个网址</span></p>';
    	global $post;
        $n =io_get_option('failure_valve');
        $args = array(
            'post_type' => 'sites',// 文章类型
            'post_status' => 'publish',
            'meta_key' => 'invalid', 
            'meta_type' => 'NUMERIC', 
            'meta_value' => $n,
            'meta_compare' => '>'
        );
        $invalid_items = new WP_Query( $args ); 
        if ($invalid_items->have_posts()) : 
            echo '<p><i class="dashicons-before dashicons-admin-site"></i> 有 '.$invalid_items->found_posts.' 个网址可能失效了(死链)</p>';
            echo '<ul style="padding-left:20px">';
            echo '<span>失效列表：</span><br>';
            while ( $invalid_items->have_posts() ) : $invalid_items->the_post();
                echo '<li style="display:inline-block;margin-right:10px"><a href="'.get_edit_post_link().'">'.get_the_title().'</a></li>';
            endwhile;
            echo '<br><span>请手动检测一下，如果没有问题，请点击对应网址进入编辑，然后修改自定义字段“invalid”的值为0</span>';
            echo '</ul>';
        else:
            echo '<p><i class="dashicons-before dashicons-admin-site"></i> 所有网址都可以正常访问</p>';
        endif; 
        wp_reset_query();
    }
}
# 后台检测投稿状态
# --------------------------------------------------------------------
add_action('admin_bar_menu', 'pending_prompt_menu', 2000);
function pending_prompt_menu() {
    global $wp_admin_bar;
    $menu_id = 'pending';
    $args = array(
        'post_type' => 'sites',// 文章类型
        'post_status' => 'pending',
    );
    $pending_items = new WP_Query( $args ); 
    if ($pending_items->have_posts()) : 
        $wp_admin_bar->add_menu(array(
            'id' => $menu_id,  
            'title' => '<span class="update-plugins count-2" style="display: inline-block;background-color: #d54e21;color: #fff;font-size: 9px;font-weight: 600;border-radius: 10px;z-index: 26;height: 18px;margin-right: 5px;"><span class="update-count" style="display: block;padding: 0 6px;line-height: 17px;">'.$pending_items->found_posts.'</span></span>个网址待审核', 
            'href' => get_bloginfo('url')."/wp-admin/edit.php?post_status=pending&post_type=sites"
        ));	 
    endif; 
    wp_reset_query();
}
# 格式化 url
# --------------------------------------------------------------------
function format_url($url){
    if($url == '')
    return;
    $url = rtrim($url,"/");
    if(io_get_option('ico-source')['url_format']){
        $pattern = '@^(?:https?://)?([^/]+)@i';
        $result = preg_match($pattern, $url, $matches);
        return $matches[1];
    }
    else{
        return $url;
    }
} 
# 格式化数字 $precision int 精度
# --------------------------------------------------------------------
function format_number($n, $precision = 2)
{
   return $n;
   if ($n < 1e+3) {
       $out = number_format($n);
   } else {
       $out = number_format($n / 1e+3, $precision) . 'k';
   }
   return $out;
}
# 获取点赞数
# --------------------------------------------------------------------
function get_like($id){
    if ( !$like_count = get_post_meta( $id, '_like_count', true ) ) {
        if(io_get_option('views_n')>0){
            $like_count = mt_rand(0, 10)*io_get_option('like_n');
            update_post_meta( $id, '_like_count', $like_count );
        }
        else
            $like_count = 0;
    }
    return format_number($like_count);
} 
# 浏览总数
# --------------------------------------------------------------------
function author_posts_views($author_id = 'all',$display = true){
    global $wpdb;
    if($author_id == 'all')
        $sql = "SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key='views'";
    else
        $sql = "SELECT SUM(meta_value+0) FROM $wpdb->posts left join $wpdb->postmeta on ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE meta_key = 'views' AND post_author =$author_id";    
    $comment_views = intval($wpdb->get_var($sql));
    if($display) {
        echo number_format_i18n($comment_views);
    } else {
        return $comment_views;
    }
}
# 网址块样式
# --------------------------------------------------------------------
function get_columns($display = true){
	$class = '';
	switch(io_get_option('columns')) {
		case 2: 
			$class = ' col-sm-6 ';
			break;
		case 3: 
			$class = ' col-sm-6 col-md-4 ';
			break;
		case 4: 
			$class = ' col-sm-6 col-md-4 col-lg-3 ';
			break;
		case 6: 
			$class = ' col-sm-6 col-md-4 col-lg-3 col-xl-2 ';
			break;
		default: 
			$class = ' col-sm-6 col-md-4 col-lg-3 ';
	} 
	if($display)
		echo $class;
	else
		return $class;
}
# 时间格式转化
# --------------------------------------------------------------------
function timeago( $ptime ) {
    date_default_timezone_set('PRC');
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return __('刚刚', 'i_theme');
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  __('年前', 'i_theme').' ('.date('Y', $ptime).')',
        30 * 24 * 60 * 60       =>  __('个月前', 'i_theme'),
        7 * 24 * 60 * 60        =>  __('周前', 'i_theme'),
        24 * 60 * 60            =>  __('天前', 'i_theme'),
        60 * 60                 =>  __('小时前', 'i_theme'),
        60                      =>  __('分钟前', 'i_theme'),
        1                       =>  __('秒前', 'i_theme')
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
# 评论高亮作者
# --------------------------------------------------------------------
function is_master($email = '') {
    if( empty($email) ) return;
    $handsome = array( '1' => ' ', );
    $adminEmail = get_option( 'admin_email' );
    if( $email == $adminEmail ||  in_array( $email, $handsome )  )
    echo '<span class="is-author"  data-toggle="tooltip" data-placement="right" title="博主"><i class="iconfont icon-user icon-fw"></i></span>';
}
# 头衔
# --------------------------------------------------------------------
function site_rank( $comment_author_email, $user_id ) {
    //$comment_rank = io_get_option( 'comment_rank' );
	//if ( ! $comment_rank ) return false;

	$v1 = 'Vip1';
	$v2 = 'Vip2';
	$v3 = 'Vip3';
	$v4 = 'Vip4';
	$v5 = 'Vip5';
	$v6 = 'Vip6';

	global $wpdb;
	$adminEmail = get_option( 'admin_email' );
	$num = count( $wpdb->get_results( "SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' " ) );

	if ( $num > 0 && $num < 6 ) {
		$rank = $v1;
	}
	elseif ( $num > 5 && $num < 11 ) {
		$rank = $v2;
	}
	elseif ( $num > 10 && $num < 16 ) {
		$rank = $v3;
	}
	elseif ($num > 15 && $num < 21) {
		$rank = $v4;
	}
	elseif ( $num > 20 && $num < 26 ) {
		$rank = $v5;
	}
	elseif ( $num > 25 ) {
		$rank = $v6;
	}

	if( $comment_author_email != $adminEmail )
		return $rank = '<span class="rank" data-toggle="tooltip" data-placement="right" title="头衔：'. $rank .'，累计评论：'. $num .'">'. $rank .'</span>';
}
# 评论格式
# --------------------------------------------------------------------
if(!function_exists('my_comment_format')){
	function my_comment_format($comment, $args, $depth){
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="comment_body d-flex flex-fill">	
				<div class="profile mr-2 mr-md-3"> 
                    <?php 
                    echo  get_avatar( $comment, 96, '', get_comment_author() );
                    ?>
				</div>					
				<section class="comment-text d-flex flex-fill flex-column">
					<div class="comment-info d-flex align-items-center mb-1">
						<div class="comment-author text-sm"><?php comment_author_link(); ?>
						<?php is_master( $comment->comment_author_email ); echo site_rank( $comment->comment_author_email, $comment->user_id ); ?>
						</div>										
					</div>
					<div class="comment-content d-inline-block text-sm">
						<?php comment_text(); ?> 
			    	    <?php
    		    	    if ($comment->comment_approved == '0'){
      		    	    echo '<span class="cl-approved">(您的评论需要审核后才能显示！)</span><br />';
    		    	    } 
			    	    ?>
					</div>
					<div class="d-flex flex-fill text-xs text-muted pt-2">
						<div class="comment-meta">
							<div class="info"><time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' );?>"><?php echo timeago(get_comment_date('Y-m-d G:i:s'));?></time></div>
						</div>
						<div class="flex-fill"></div>
						<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					</div>
				</section>
			</div>
	 	
		<?php
	}
}
# 某作者文章浏览数
# --------------------------------------------------------------------
if(!function_exists('author_posts_views')) {
	function author_posts_views($author_id = 1 ,$display = true) {
		global $wpdb;
		$sql = "SELECT SUM(meta_value+0) FROM $wpdb->posts left join $wpdb->postmeta on ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE meta_key = 'views' AND post_author =$author_id";
		$comment_views = intval($wpdb->get_var($sql));
		if($display) {
			echo number_format_i18n($comment_views);
		} else {
			return $comment_views;
		}
	}
}
# 获取作者所有文章点赞数
# --------------------------------------------------------------------
if(!function_exists('author_posts_likes')) {
    function author_posts_likes($author_id = 'all' ,$display = true) {
        global $wpdb;
        if($author_id == 'all')
            $sql = "SELECT sum(meta_value) FROM $wpdb->postmeta WHERE meta_key='_like_count'";
        else
            $sql = "SELECT SUM(meta_value+0) FROM $wpdb->posts left join $wpdb->postmeta on ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE meta_key = '_like_count' AND post_author = $author_id ";
            
        $posts_likes = intval($wpdb->get_var($sql));	
        if($display) {
            echo number_format_i18n($posts_likes);
        } else {
            return $posts_likes;
        }
    }
}
# 获取热门文章
# --------------------------------------------------------------------
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $show_thumbs = false, $newWindow='', $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
            $temp .= "<div class='list-item py-2'>";
            if($show_thumbs){
                $temp .= "<div class='media media-3x2 rounded col-4 mr-3'>";
                $thumbnail = io_get_thumbnail(array('width'=>200,'height'=>150),true);
                if(io_get_option('lazyload'))
                    $temp .= '<a class="media-content" href="'.get_permalink().'" '. $newWindow .' title="'.get_the_title().'" data-src="'.$thumbnail.'"></a>';
                else
                    $temp .= '<a class="media-content" href="'.get_permalink().'" '. $newWindow .' title="'.get_the_title().'" style="background-image: url('.$thumbnail.');"></a>';
                $temp .= "</div>"; 
            }
            $temp .= '
                <div class="list-content py-0">
                    <div class="list-body">
                        <a href="'.get_permalink().'" class="list-title overflowClip_2" '. $newWindow .' rel="bookmark">'.get_the_title().'</a>
                    </div>
                    <div class="list-footer">
                        <div class="d-flex flex-fill text-muted text-xs">
                            <time class="d-inline-block">'.timeago(get_the_time('Y-m-d G:i:s')).'</time>
                            <div class="flex-fill"></div>' 
                            .the_views( false, '<span class="views"><i class="iconfont icon-chakan"></i> ','</span>' ).
                        '</div>
                    </div> 
                </div> 
            </div>'; 
		}
	} else {
		$temp = "<div class='list-item py-2'>暂无文章</div>";
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}
# 获取热门网址
# --------------------------------------------------------------------
function get_sites_most_viewed($number = 5, $days = 7, $newWindow='', $display = true) {
	global $wpdb, $post;
	$args = array(
        'post_type' => 'sites',// 文章类型
        'post_status' => 'publish',
        'posts_per_page' => $number, // 文章数量 
        'orderby' => array( 'meta_value_num' => 'DESC', 'ID' => 'DESC' ),
        'meta_key' => 'views',
        'date_query' => array(
            array(
                'after' => ''.$days. 'day ago',//day week month
            ),
        ),
    );
        $related_items = new WP_Query( $args ); 
        if ($related_items->have_posts()) :
            while ( $related_items->have_posts() ) : $related_items->the_post();
            $sites_type = get_post_meta($post->ID, '_sites_type', true);
            $link_url = get_post_meta($post->ID, '_sites_link', true); 
            $default_ico = get_template_directory_uri() .'/images/favicon.png';
            $ico = get_post_meta_img($post->ID, '_thumbnail', true);
            if($ico == ''){
                if( $link_url != '' || ($sites_type == "sites" && $link_url != '') )
                    $ico = (io_get_option('ico-source')['ico_url'] .format_url($link_url) . io_get_option('ico-source')['ico_png']);
                elseif($sites_type == "wechat")
                    $ico = get_template_directory_uri() .'/images/qr_ico.png';
                elseif($sites_type == "down")
                    $ico = get_template_directory_uri() .'/images/down_ico.png';
                else
                    $ico = $default_ico;
            }

            if(current_user_can('level_10') || !get_post_meta($post->ID, '_visible', true)):
                echo '<div class="url-card col-6 '. before_class($post->ID) .'">';
                echo '<a href="'.get_permalink().'" '.$newWindow.' class="card mb-2">
                <div class="card-body" style="padding:0.3rem 0.5rem;">
                <div class="url-content">
                    <div class="url-img">';
                        if(io_get_option('lazyload')):
                            echo '<img class="rounded-circle lazy" src="'.$default_ico.'" data-src="'.$ico.'" onerror="javascript:this.src='.$default_ico.'" width="20">';
                        else:
                            echo '<img class="rounded-circle lazy" src="'.$ico.'" onerror="javascript:this.src='.$default_ico.'" width="20">';
                        endif;
                        echo '</div>
                        
                    <div class="url-info">
                    <div class="text-xs overflowClip_1">'.get_the_title().'</div>
                    </div>
                </div>
                </div>
            </a> 
            </div>';
              
            endif;
            endwhile; 
        endif; 
        wp_reset_query();
}


# 替换用户链接
# --------------------------------------------------------------------
add_filter('author_link', 'author_link', 10, 2);
function author_link( $link, $author_id) {
    global $wp_rewrite;
    $author_id = (int) $author_id;
    $link = $wp_rewrite->get_author_permastruct();
    if ( empty($link) ) {
        $file = home_url( '/' );
        $link = $file . '?author=' . $author_id;
    } else {
        $link = str_replace('%author%', $author_id, $link);
        $link = home_url( user_trailingslashit( $link ) );
    }
    return $link;
}
add_filter('request', 'author_link_request');
function author_link_request( $query_vars ) {
    if ( array_key_exists( 'author_name', $query_vars ) ) {
        global $wpdb;
        $author_id=$query_vars['author_name'];
        if ( $author_id ) {
            $query_vars['author'] = $author_id;
            unset( $query_vars['author_name'] );    
        }
    }
    return $query_vars;
}
# 屏蔽用户名称类
# --------------------------------------------------------------------
add_filter('comment_class','remove_comment_body_author_class');
add_filter('body_class','remove_comment_body_author_class');
function remove_comment_body_author_class( $classes ) {
	foreach( $classes as $key => $class ) {
	if(strstr($class, "comment-author-")||strstr($class, "author-")) {
			unset( $classes[$key] );
		}
	}
	return $classes;
}
# 禁止谷歌字体
# --------------------------------------------------------------------
add_action( 'init', 'remove_open_sans' );
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
# 字体增加
# --------------------------------------------------------------------
add_filter('tiny_mce_before_init', 'custum_fontfamily');
function custum_fontfamily($initArray){  
   $initArray['font_formats'] = "微软雅黑='微软雅黑';宋体='宋体';黑体='黑体';仿宋='仿宋';楷体='楷体';隶书='隶书';幼圆='幼圆';";  
   return $initArray;  
} 
# 移除 WordPress 文章标题前的“私密/密码保护”提示文字
# --------------------------------------------------------------------
add_filter('private_title_format', 'remove_title_prefix');//私密
add_filter('protected_title_format', 'remove_title_prefix');//密码保护
function remove_title_prefix($content) {
	return '%s';
}
# 文章自动nofollow
# --------------------------------------------------------------------
add_filter( 'the_content', 'ioc_seo_wl');
function ioc_seo_wl( $content ) {
    $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
    if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
        if( !empty($matches) ) {
            $srcUrl = get_option('siteurl');
            for ($i=0; $i < count($matches); $i++)
            {
                $tag = $matches[$i][0];
                $tag2 = $matches[$i][0];
                $url = $matches[$i][0];
   
                $noFollow = '';
                $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 ){
                    $noFollow .= ' target="_blank" ';
                }
                $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                if( count($match) < 1 ){
                    $noFollow .= ' rel="nofollow" ';
                }
                $pos = strpos($url,$srcUrl);
                if ($pos === false) {
                    $tag = rtrim ($tag,'>');
                    $tag .= $noFollow.'>';
                    $content = str_replace($tag2,$tag,$content);
                }
            }
        }
    }
    $content = str_replace(']]>', ']]>', $content);
    return $content;
}
# 定制CSS
# --------------------------------------------------------------------
add_action('wp_head','modify_css');
function modify_css(){
	if (io_get_option("custom_css")) {
		$css = substr(io_get_option("custom_css"), 0);
		echo "<style>" . $css . "</style>";
	}
}
# 移除系统菜单模块
# -------------------------------------------------------------------- 
if ( is_admin() ) {   
    //add_action('admin_init','remove_submenu');  
    function remove_submenu() {   
        remove_submenu_page( 'themes.php', 'theme-editor.php' );   //移除主题编辑页
    }  
}  
# 重写规则
# --------------------------------------------------------------------
add_action('generate_rewrite_rules', 'io_rewrite_rules' );  
function io_rewrite_rules( $wp_rewrite ){   
    $new_rules = array(    
        'go/?$'          => 'index.php?custom_page=go',
    ); //添加翻译规则   
    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;   
    //php数组相加   
}  
add_action('query_vars', 'io_add_query_vars');   
function io_add_query_vars($public_query_vars){     
    $public_query_vars[] = 'custom_page'; //往数组中添加添加custom_page   
       
    return $public_query_vars;     
}   
add_action("template_redirect", 'io_template_redirect');   //模板载入规则  
function io_template_redirect(){   
    global $wp;   
    global $wp_query, $wp_rewrite;   
       
    //查询custom_page变量   
    @$reditect_page =  $wp_query->query_vars['custom_page'];   
    //如果custom_page等于go，则载入go.php页面   
    //注意 my-account/被翻译成index.php?custom_page=hello_page了。    
    if($reditect_page=='go'){
        include(TEMPLATEPATH.'/go.php');   
        die(); 
    }
}
# 激活主题更新重写规则
# --------------------------------------------------------------------
add_action( 'load-themes.php', 'io_flush_rewrite_rules' );   
function io_flush_rewrite_rules() {   
    global $pagenow, $wp_rewrite;   
    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )   
        $wp_rewrite->flush_rules();   
}
# 自定义图标
# --------------------------------------------------------------------
class iconfont {
	function __construct(){
		add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_class' ),1,3 );
		add_filter( 'walker_nav_menu_start_el', array( $this, 'walker_nav_menu_start_el' ), 10, 4 );
    } 

	function nav_menu_css_class($classes, $item, $args){
        if($args->theme_location == 'nav_main') { //这里的 main 是菜单id
            $classes[] = 'sidebar-item'; //这里的 nav-item 是要添加的class类
        } 

		if( is_array( $classes ) ){
			$tmp_classes = preg_grep( '/^(fa[b|s]?|io)(-\S+)?$/i', $classes );
			if( !empty( $tmp_classes ) ){
				$classes = array_values( array_diff( $classes, $tmp_classes ) );
			}
		}
		return $classes;
	}

	protected function replace_item( $item_output, $classes ){
		//if( !in_array( 'fa', $classes ) ){
		//	array_unshift( $classes, 'fa' );
		//}
		$before = true;
        $icon = '
        <i class="' . implode( ' ', $classes ) . ' icon-fw icon-lg mr-2"></i>';
		preg_match( '/(<a.+>)(.+)(<\/a>)/i', $item_output, $matches );
		if( 4 === count( $matches ) ){
			$item_output = $matches[1];
			if( $before ){
                $item_output .= $icon . '
                <span>' . $matches[2] . '</span>';
                //<span class="label-Primary">♥</span>';
			} else {
                $item_output .= '
                <span>' . $matches[2] . '</span>
                ' . $icon;
			}
			$item_output .= $matches[3];
		}
		return $item_output;
	}

	function walker_nav_menu_start_el( $item_output, $item, $depth, $args ){
		if( is_array( $item->classes ) ){
			$classes = preg_grep( '/^(fa[b|s]?|io)(-\S+)?$/i', $item->classes );
			if( !empty( $classes ) ){
				$item_output = $this->replace_item( $item_output, $classes );
			}
		}
		return $item_output;
	}
}
new iconfont();
# 搜索只查询文章和网址。
# --------------------------------------------------------------------
add_filter('pre_get_posts','searchfilter');
function searchfilter($query) {
    //限定对搜索查询和非后台查询设置
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('sites','post'));
    }
    return $query;
}
# 修改搜索查询的sql代码，将postmeta表左链接进去。
# --------------------------------------------------------------------
add_filter('posts_join', 'cf_search_join' );
function cf_search_join( $join ) {
    if(is_admin())
        return $join;
    global $wpdb;
    if ( is_search() ) {
      $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}
add_filter('posts_where', 'cf_search_where');// 在wordpress查询代码中加入自定义字段值的查询。
function cf_search_where( $where ) {
    if(is_admin())
        return $where; 
    global $pagenow, $wpdb;
    if ( is_search() ) {
        $where = preg_replace("/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
        "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }
    return $where;
}
add_filter ('posts_distinct', 'cf_search_distinct');// 去重
function cf_search_distinct($where) {
    if(is_admin())
        return $where;
    global $wpdb;
    if ( is_search() )  {
      return "DISTINCT";
    }
    return $where;
}

