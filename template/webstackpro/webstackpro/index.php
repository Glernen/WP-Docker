<?php if ( ! defined( 'ABSPATH' ) ) { exit; }?>
<?php get_header();?>


<?php 
$categories= get_categories(array(
    'taxonomy'     => 'favorites',
    'meta_key'     => '_term_order',
    'orderby'      => 'meta_value_num',
    'order'        => 'desc',
    'hide_empty'   => 0,
)); 
include( 'templates/sidebar-nav.php' );
?>
<div class="main-content flex-fill">
<?php include( 'templates/header-banner.php' ); ?>

    <div id="content" class="content-site customize-site">

    <?php 
    // 加载公告模块
    get_template_part( 'templates/bulletin' );  

    // 加载搜索模块
    if( in_array("home",io_get_option('search_position')) ){
        get_template_part( 'templates/tools','search' );
    } else {
        echo '<div class="no-search my-2 p-1"></div>';
    }

    // 加载广告模块
    get_template_part( 'templates/ads','hometop' );

    // 加载文章模块
    get_template_part( 'templates/article','list' ); 

    // 加载文章模块
    get_template_part( 'templates/post','card' ); 

    // 加载自定义模块
    get_template_part( 'templates/tools','customize' ); 

    // 加载热门网址模块
    get_template_part( 'templates/tools','hot' ); 

    // 加载广告模块second
    get_template_part( 'templates/ads','homesecond' );

    // 加载网址模块
    foreach($categories as $category) {
        if($category->category_parent == 0){
            $children = get_categories(array(
                'taxonomy'   => 'favorites',
                'meta_key'   => '_term_order',
                'orderby'    => 'meta_value_num',
                'order'      => 'desc',
                'child_of'   => $category->term_id,
                'hide_empty' => 0
            ));
            if(empty($children)){ 
                fav_con($category);
            }else{
                if(io_get_option("tab_type")) {
                    fav_con_tab($children,$category->term_id,$category->name);
                }else{
                    foreach($children as $mid) {
                        fav_con($mid,$category->name);
                    }
                }
            }
        }
    } 
      
    // 加载广告模块link
    get_template_part( 'templates/ads','homelink' );
    // 加载友链模块
    get_template_part( 'templates/friendlink' ); ?>   
    </div> 
<?php
get_footer();
