<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * 百度主动推送
 */
if (io_get_option('baidu_submit')['switcher']) {
    // 主动推送
    if(!function_exists('Baidu_Submit')){
        function Baidu_Submit($post_ID) {
            $WEB_DOMAIN = get_option('home');
            if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
            $url = get_permalink($post_ID);
            $api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.io_get_option('baidu_submit')['token_p'];
            $request = new WP_Http;
            $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
            $result = json_decode($result['body'],true);
            if (array_key_exists('success',$result)) {
                add_post_meta($post_ID, 'Baidusubmit', 1, true);
            }
        }
        add_action('publish_post', 'Baidu_Submit', 0);
    }
}

 
/**
 * 熊掌号自动推送
 */
if ( io_get_option('baidu_xzh')['switcher']) {
	if(!function_exists('Baidu_XZH_Submit')){
		function Baidu_XZH_Submit($post_ID) {
			//已成功推送的文章不再推送
			if(get_post_meta($post_ID,'BaiduXZHsubmit',true) == 1) return;
			$url = get_permalink($post_ID);
			$api = 'http://data.zz.baidu.com/urls?appid='. io_get_option('baidu_xzh')['xzh_id'].'&token='. io_get_option('baidu_xzh')['xzh_token'].'&type=realtime';
			$request = new WP_Http;
			$result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
			$result = json_decode($result['body'],true);
			//如果推送成功则在文章新增自定义栏目BaiduXZHsubmit，值为1
			if (array_key_exists('success_realtime',$result)) {
				add_post_meta($post_ID, 'BaiduXZHsubmit', 1, true);
			}
		}
		add_action('publish_post', 'Baidu_XZH_Submit', 0);
	}
}
 
/**
 * 获取文章/页面摘要
 */
function io_baidu_excerpt($len=220){
	if ( is_single() || is_page() ){
		global $post;
		if ($post->post_excerpt) {
			$excerpt  = $post->post_excerpt;
		} else {
			if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
				$post_content = $result['1'];
			} else {
				$post_content_r = explode("\n",trim(strip_tags($post->post_content)));
				$post_content = $post_content_r['0'];
			}
			$excerpt = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,0}'.'((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s','$1',$post_content);
		}
		return str_replace(array("\r\n", "\r", "\n"), "", $excerpt);
	}
} 
/**
 * 获取文章中的三张图 
 */
function io_baidu_post_img(){
	global $post;
	$content = $post->post_content;  
	preg_match_all('/<img .*?src=[\"|\'](.+?)[\"|\'].*?>/', $content, $strResult, PREG_PATTERN_ORDER); 
	$n = count($strResult[1]);  
	if($n >= 3){
		$src = $strResult[1][0].'","'.$strResult[1][1].'","'.$strResult[1][2];
	}else{
		if( $values = get_post_custom_values("thumbnail") ) {
			$values = get_post_custom_values("thumbnail");
			$src = $values [0];
		} elseif( has_post_thumbnail() ){
			$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
			$src = $thumbnail_src [0];
		} else {
			if($n > 0){
				$src = $strResult[1][0];
			}  else {
				$src ='';
			}
		}
	}
	return $src;
}
 
/**
 * 添加熊掌号关注按钮
 */
//if(io_get_option('baidu_xzh')['xzh_gz']) add_action('wp_head','baidu_xzh');
function baidu_xzh() {
	if(is_single()){
		echo '<script type="application/ld+json">{
	"@context": "https://ziyuan.baidu.com/contexts/cambrian.jsonld",
	"@id": "'.get_the_permalink().'",
 	"appid": "'. io_get_option('baidu_xzh')['xzh_id'] .'",
	"title": "'.get_the_title().'",
	"images": ["'.io_baidu_post_img().'"],
	"description": "'.io_baidu_excerpt().'",
	"pubDate": "'.get_the_time('Y-m-d\TH:i:s').'"
}</script>';}
	echo "\n";
	echo '<script src="//msite.baidu.com/sdk/c.js?appid='. io_get_option('baidu_xzh')['xzh_id'] .'"></script>';
	echo "\n";
}
