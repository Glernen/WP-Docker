<?php if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header(); ?>


<?php 
$categories= get_categories(array(
  'taxonomy'     => 'favorites',
  'meta_key'     => '_term_order',
  'orderby'      => 'meta_value_num',
  'order'        => 'desc',
  'hide_empty'   => 0,
  )
); 
include( 'templates/sidebar-nav.php' );
?>
	<div class="main-content flex-fill">
    
	<?php include( 'templates/header-banner.php' ); ?>
    	<div id="content" class="content-site customize-site">
			<div id="search" class="s-search mx-auto my-4">
				<form name="formsearch" method="get" action="<?php bloginfo('url'); ?>?s=" id="super-search-fm">
    		        <input type="text" id="search-text" name="s" class="search-keyword" placeholder="输入关键字搜索" style="outline:0"/> 
    		        <button type="submit" οnmοuseοut="this.className='select_class'" οnmοuseοver="this.className='select_over'" ><i class="iconfont icon-search "></i></button>
    		    </form>
			</div>
			<h4 class="text-gray text-lg mb-4"><i class="iconfont icon-search mr-1"></i>“<?php echo $s; ?>” <?php _e('的搜索结果','i_theme'); ?></h4>
        	<div class="row">
                 
			<?php if ( !have_posts() ) : ?>
				<div class="col-lg-12">
            		<div class="nothing">没有内容</div>
          		</div>
    		<?php endif; ?>
			
			
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
	
<?php
get_footer(); 