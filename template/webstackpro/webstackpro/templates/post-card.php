<?php if ( ! defined( 'ABSPATH' ) ) { exit; }  ?>
<?php 
if(io_get_option('post_card_list')){
    $categorys = explode(',', io_get_option('post_card_list'));
    foreach ($categorys as $cat_id){
        $args = array(
            'category__and' => $cat_id,
            'ignore_sticky_posts' => 1,
        );
        $posts = new WP_Query( $args );
        if ( $posts->have_posts() ) :
    ?>
    <div class="d-flex flex-fill ">
        <h4 class="text-gray text-lg">
            <i class="site-tag iconfont icon-publish icon-lg mr-1" ></i><?php echo get_cat_name( $cat_id ) ?></h4>
        <div class="flex-fill"></div>
        <a class='btn-move text-xs' href='<?php echo get_category_link( $cat_id );?>'>more+</a>
    </div>
    <div class="list-post row"> 
        <?php 
        while (  $posts->have_posts() ) :  $posts->the_post();
        ?>  
    	<div class="col-6 col-md-4 col-xl-3 col-xxl-2 py-2 py-md-3">
    		<div class="card-post list-item">
                <div class="media media-4x3 p-0 rounded">
                    <?php if(io_get_option('lazyload')): ?>
                    <a class="media-content" href="<?php the_permalink(); ?>" <?php echo new_window() ?> data-src="<?php echo io_get_thumbnail(array('width'=>400,'height'=>300),true) ?>"></a>
                    <?php else: ?>
                    <a class="media-content" href="<?php the_permalink(); ?>" <?php echo new_window() ?>  style="background-image: url(<?php echo io_get_thumbnail(array('width'=>400,'height'=>300),true) ?>);"></a>
                    <?php endif ?>
                </div>
                <div class="list-content">
                    <div class="list-body">
                        <a href="<?php the_permalink(); ?>" target="_blank" class="list-title text-md overflowClip_2">
                        <?php the_title(); ?>
                        </a>
                    </div>
                    <div class="list-footer">
                        <div class="d-flex flex-fill align-items-center">
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" class="flex-avatar mr-1">
                            <?php echo get_avatar( get_the_author_meta('email'), '20' ); ?>               
                            </a>
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" class="d-none d-md-inline-block text-xs" target="_blank"><?php echo get_the_author() ?></a>
                            <div class="flex-fill"></div>
                            <div class="text-muted text-xs">
                                <?php 
    				            if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views mr-1"><i class="iconfont icon-chakan mr-1"></i>','</span>' ); }
                                ?>
                                <a href="<?php the_permalink(); ?>"><i class="iconfont icon-heart mr-1"></i><?php echo get_like(get_the_ID()) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>								
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; wp_reset_postdata(); ?>
<?php }
} ?>