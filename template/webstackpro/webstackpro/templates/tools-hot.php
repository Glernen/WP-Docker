<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if(io_get_option('hot_card')){ ?>
        <div class='slider_menu mini_tab ajax-list mb-4' sliderTab="sliderTab" >
            <ul class="nav nav-pills menu" role="tablist"> 
                <li class="pagenumber nav-item">
                    <a class="nav-link active" data-action="load_hot_sites" data-type="views" >热门网址</a>
                </li>
                <li class="pagenumber nav-item">
                    <a class="nav-link" data-action="load_hot_sites" data-type="_like_count" >大家喜欢</a>
                </li>
            </ul>
        </div> 
        <div class="row <?php echo io_get_option("hot_card_mini")?"row-sm":"" ?> ajax-list-body" style="position: relative;">
        <?php   
        
        global $post;
        $site_n = io_get_option('hot_n');
        $args = array(
            'post_type'           => 'sites',        
            'ignore_sticky_posts' => 1,              
            'posts_per_page'      => $site_n,       
            'meta_key'            => 'views',
            'orderby'             => array( 'meta_value_num' => 'DESC', 'ID' => 'DESC' ), 
        );
        $myposts = new WP_Query( $args );
        if(!$myposts->have_posts()): ?>
            <div class="col-lg-12">
                <div class="nothing mb-4">没有数据！请开启统计并等待产生数据</div>
            </div>
        <?php
        elseif ($myposts->have_posts()): while ($myposts->have_posts()): $myposts->the_post(); 
            $link_url = get_post_meta($post->ID, '_sites_link', true); 
            $default_ico = get_template_directory_uri() .'/images/favicon.png';
            if(current_user_can('level_10') || !get_post_meta($post->ID, '_visible', true)):
        ?>
            <div class="url-card <?php echo io_get_option('two_columns')?"col-6":"" ?> <?php echo io_get_option("hot_card_mini")?"col-6 col-xxl-10":"" ?> <?php get_columns() ?> <?php echo before_class($post->ID) ?>">
            <?php
            if(io_get_option("hot_card_mini"))
            include( get_theme_file_path() .'/templates/site-minicard.php' ); 
            else
            include( get_theme_file_path() .'/templates/site-card.php' );
            ?>
            </div>
        <?php endif; endwhile; endif; wp_reset_postdata(); ?>
        </div>   
<?php } ?>
