<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>


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

    <div id="content" class="content-site">

    <?php
    // 加载搜索模块 
    if( in_array("home",io_get_option('search_position')) ){
        get_template_part( 'templates/tools','search' );
    } else {
        echo '<div class="no-search my-2 p-1"></div>';
    }
    ?>
    
    <h4 class="text-gray text-lg mb-4">
        <i class="site-tag iconfont icon-tag icon-lg mr-1" id="<?php single_cat_title() ?>"></i><?php single_cat_title() ?>
    </h4>
    <div class="row">  
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); 
		$link_url = get_post_meta($post->ID, '_sites_link', true); 
        $default_ico = get_template_directory_uri() .'/images/favicon.png';
		if(current_user_can('level_10') || !get_post_meta($post->ID, '_visible', true)):
		?>
			<div class="url-card <?php echo io_get_option('two_columns')?"col-6":"" ?> <?php get_columns() ?> <?php echo before_class($post->ID) ?>">
            <?php include( 'templates/site-card.php' ); ?>
        	</div>
    	<?php endif; endwhile; endif;?>
    </div>  
	<div class="posts-nav mb-4">
	    <?php echo paginate_links(array(
	        'prev_next'          => 0,
	        'before_page_number' => '',
	        'mid_size'           => 2,
	    ));?>
	</div>
  </div>

<?php get_footer(); ?>
