<?php  if ( ! defined( 'ABSPATH' ) ) { exit; }  
if(io_get_option('article_module')) :
?>
<div class="slice-article mb-4"> 
<div class="row no-gutters card-group">
    <div class="banner-left col-12 col-md-7 col-lg-8 col-xl-6"> 
        <?php include( 'slide-blog.php' ); ?>
    </div>
    <div class="col-12 col-xl-3 d-none d-xl-block pl-0 pl-md-1">
        <div class="my-n1">

        <?php
        if(io_get_option('two_article')){
            $args = array(
                'post__in' => explode(',', io_get_option('two_article')),
                'posts_per_page' => -1
            );
        }else{
            $args = array( 
                'numberposts' => 2, 
                'post__not_in' => get_option( 'sticky_posts' ),
                'orderby' => 'rand', 
                'post_status' => 'publish' 
            );
        }
            $rand_posts = get_posts( $args );
            foreach( $rand_posts as $post ) : ?>
            <div class="col-lg-12 p-1">
                <div class="list-item">
                    <div class="media rounded">
                        <?php if(io_get_option('lazyload')): ?>
                        <a class="media-content" href="<?php the_permalink(); ?>" <?php echo new_window() ?> data-src="<?php echo io_get_thumbnail(array('width'=>600,'height'=>300),true) ?>">
                        <?php else: ?>
                        <a class="media-content" href="<?php the_permalink(); ?>" <?php echo new_window() ?>  style="background-image: url(<?php echo io_get_thumbnail(array('width'=>600,'height'=>300),true) ?>);">
                        <?php endif ?>
                            <span class="media-title d-none d-md-block overflowClip_1"><?php the_title(); ?></span>
                        </a>                                                       
                    </div>
                        
                </div>
            </div>
            <?php endforeach; wp_reset_postdata(); ?>                       
        </div>
    </div>
    <div class="col-12 col-md-5 col-lg-4 col-xl-3 mt-4 mt-md-0 pl-0 pl-md-2 pl-xl-1">
        <div class="card new-news  hidden-xs">
            <h3 class="h6 news_title"><i class="iconfont icon-category"></i>&nbsp;&nbsp;最新资讯</h3>
            <a class="news_all_btn text-xs" href="<?php echo get_permalink(io_get_option('blog_pages')) ?>" <?php echo new_window() ?> title="所有资讯">所有</a>
            <ul>
            <?php 
            $args = array(
                'category__not_in' => explode(',', io_get_option('article_not_in')),
                'ignore_sticky_posts' => 1,
            );
            query_posts( $args );
            
            if ( have_posts() ) : while (  have_posts() ) :  the_post();?> 
                <li>
                    <i class="iconfont icon-point"></i> 
                    <a class="text-sm" href="<?php the_permalink(); ?>" <?php echo new_window() ?>><span><?php the_title(); ?></span></a>
                    <div class="d-flex flex-fill text-xs text-muted">
                        <?php 
                        $category = get_the_category();
                        if($category[0]){?>
                        <a class="mr-2" href="<?php echo get_category_link($category[0]->term_id ) ?>" <?php echo new_window() ?>><?php echo $category[0]->cat_name ?></a>
                        <?php } ?>
                        <div class="flex-fill"></div>
                        <?php echo get_the_time('Y-m-d') ?>
                    </div>
                </li> 
            <?php endwhile; endif; wp_reset_query(); ?>
            </ul>
        </div>
    </div>
</div>
</div>
<?php endif; ?>
