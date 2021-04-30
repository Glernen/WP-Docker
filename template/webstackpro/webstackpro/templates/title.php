<?php 
$title = "";
$title_after = ' | ' . get_bloginfo('name');
$keywords="";
$description="";
$type = 'article';
$url = get_bloginfo('url');
$img = io_get_option("og_img")['url']?:get_template_directory_uri().'/screenshot.jpg';
if( is_single() || is_page() ) {
	$title = get_the_title();
	$id=get_the_ID();
	$tag = '';
	$tags=get_the_tags();
	$excerpt=preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/",'',get_the_excerpt($id));
	$url = get_permalink();
	$img = io_theme_get_thumb();
	if( get_post($id)->post_type == 'sites' ){
		$tags=get_the_terms($id, 'sitetag');
		$img = get_post_meta_img($id, '_thumbnail', true);
		if($img == ''){
			$link_url = get_post_meta($id, '_sites_link', true); 
			if($link_url != '')
				$img = (io_get_option('ico-source')['ico_url'] .format_url($link_url) . io_get_option('ico-source')['ico_png']);
			else 
				$img = (io_get_option('ico-source')['ico_url'] .format_url(get_permalink()) . io_get_option('ico-source')['ico_png']);
		}
	}
	if( $tags ){
		foreach($tags as $val){
			$tag.=','.$val->name;
		}
	}
	$tag=ltrim($tag,',');
	if( $tag!="" ) $keywords=$tag;
	elseif( get_post($id)->post_type == 'sites' ) $keywords=get_the_title().','.get_bloginfo('name');
	elseif(io_get_option('seo_home_keywords')) $keywords=io_get_option('seo_home_keywords');
	if( !empty($excerpt)) $description=$excerpt;
	elseif( get_post($id)->post_type == 'sites' ) $description=htmlspecialchars(get_post_meta($id, '_sites_sescribe', true));
	elseif(io_get_option('seo_home_desc')) $description=io_get_option('seo_home_desc');
}
if( (is_home() || is_front_page()) && !is_paged() ){
	$title = get_bloginfo('name') . ' | ' . get_bloginfo( 'description');
	$title_after = '';
	$keywords=io_get_option('seo_home_keywords');
	$description=io_get_option('seo_home_desc');
	$type = 'website';
}
if(is_category() && !is_paged()){ 
	$cat_id = get_query_var('cat');
	$url = get_category_link($cat_id);
	$meta = get_term_meta( $cat_id, 'category_meta', true );
	if($meta && $meta['seo_title'])
		$title = $meta['seo_title'];
	else
		$title = single_cat_title("", false);
	if($meta && $meta['seo_metakey'])
		$keywords=$meta['seo_metakey'];
	else
		$keywords=single_cat_title('', false).','.get_bloginfo('name');
	if($meta && $meta['seo_desc'])
		$description=$meta['seo_desc'];
	else
		$description = category_description()?:io_get_option('seo_home_desc'); 
}
if(is_tag() && !is_paged()){ 
	$tag_id=get_query_var('tag_id');
	$url = get_tag_link($tag_id);	
	$meta = get_term_meta( $tag_id, 'post_tag_meta', true );  
	if($meta && $meta['seo_title'])
		$title = $meta['seo_title'];
	else
		$title = single_tag_title("", false);
	if($meta && $meta['seo_metakey'])
		$keywords=$meta['seo_metakey'];
	else
		$keywords=single_tag_title('', false).','.get_bloginfo('name');
	if($meta && $meta['seo_desc'])
		$description=$meta['seo_desc'];
	else
		$description=strip_tags(trim(tag_description()))?:io_get_option('seo_home_desc'); 
}
if(is_tax("favorites")){
	$cat_id = get_queried_object_id();
	$url = get_category_link($cat_id); 
	$tit = get_term_meta( $cat_id, 'seo_title', true ); 
	$key = get_term_meta( $cat_id, 'seo_metakey', true ); 
	$des = get_term_meta( $cat_id, 'seo_desc', true ); 
	if($tit!="")
		$title = $tit;
	else
		$title = single_cat_title("", false);
	if($key!="")
		$keywords=$key;
	else
		$keywords=single_cat_title('', false).','.get_bloginfo('name');
	if($des!="")
		$description=$des;
	else
		$description=io_get_option('seo_home_desc');
}
if(is_tax("sitetag")){
	$tag_id = get_queried_object_id();
	$url = get_category_link($tag_id); 
	$meta = get_term_meta( $tag_id, 'sitetag_meta', true );
	if($meta && $meta['seo_title'])
		$title = $meta['seo_title'];
	else
		$title = single_tag_title("", false);
	if($meta && $meta['seo_metakey'])
		$keywords=$meta['seo_metakey'];
	else
		$keywords=single_tag_title('', false).','.get_bloginfo('name');
	if($meta && $meta['seo_desc'])
		$description=$meta['seo_desc'];
	else
		$description=io_get_option('seo_home_desc'); 
} 
?>
<title><?php echo $title . $title_after  ?></title>
<meta name="theme-color" content="<?php echo theme_mode()=="io-black-mode"?'#2C2E2F':'#f9f9f9' ?>" />
<meta name="keywords" content="<?php echo $keywords ?>" />
<meta name="description" content="<?php echo esc_attr(stripslashes($description)) ?>" />
<meta property="og:type" content="<?php echo $type ?>">
<meta property="og:url" content="<?php echo $url ?>"/> 
<meta property="og:title" content="<?php echo $title . $title_after ?>">
<meta property="og:description" content="<?php echo $description ?>">
<meta property="og:image" content="<?php echo $img ?>">
<meta property="og:site_name" content="<?php bloginfo('name') ?>">
