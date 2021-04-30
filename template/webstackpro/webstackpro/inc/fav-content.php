<?php  if ( ! defined( 'ABSPATH' ) ) { exit; }
function fav_con($mid,$pname = "") { ?>
        <div class="d-flex flex-fill ">
            <h4 class="text-gray text-lg mb-4">
                <i class="site-tag iconfont icon-tag icon-lg mr-1" id="cat-<?php echo $mid->term_id; ?>"></i>
                <?php if( $pname != "" && io_get_option("tab_p_n")&& !wp_is_mobile() ){ 
                      echo $pname . '<span style="color:#f1404b"> · </span>';
                 } 
                 echo $mid->name; ?>
            </h4>
            <div class="flex-fill"></div>
            <?php 
            $site_n           = io_get_option('site_n');
            $category_count   = $mid->category_count;
            $count            = $site_n;
            if($site_n == 0)  $count = min(get_option('posts_per_page'),$category_count);
            if($site_n >= 0 && $count < $category_count){
                $link = esc_url( get_term_link( $mid, 'favorites' ) );
                echo "<a class='btn-move text-xs' href='$link'>more+</a>";
            }
            ?>
        </div>
        <div class="row">
        <?php   
        //定义$post为全局变量，这样之后的输出就不会是同一篇文章了
        global $post;
        //下方的posts_per_page设置最为重要
        $args = array(
            'post_type'           => 'sites',        //自定义文章类型，这里为sites
            'ignore_sticky_posts' => 1,              //忽略置顶文章
            'posts_per_page'      => $site_n,        //显示的文章数量
            'meta_key'            => '_sites_order',
            'orderby'             => array( 'meta_value_num' => 'DESC', 'ID' => 'DESC' ),
            'tax_query'           => array(
                array(
                    'taxonomy' => 'favorites',       //分类法名称
                    'field'    => 'id',              //根据分类法条款的什么字段查询，这里设置为ID
                    'terms'    => $mid->term_id,     //分类法条款，输入分类的ID，多个ID使用数组：array(1,2)
                )
            ),
        );
        $myposts = new WP_Query( $args );
        if(!$myposts->have_posts()): ?>
            <div class="col-lg-12">
                <div class="nothing mb-4">没有内容</div>
            </div>
        <?php
        elseif ($myposts->have_posts()): while ($myposts->have_posts()): $myposts->the_post(); 
            $link_url = get_post_meta($post->ID, '_sites_link', true); 
            $default_ico = get_template_directory_uri() .'/images/favicon.png';
            if(current_user_can('level_10') || !get_post_meta($post->ID, '_visible', true)):
        ?>
            <div class="url-card <?php echo io_get_option('two_columns')?"col-6":"" ?> <?php get_columns() ?> <?php echo before_class($post->ID) ?>">
            <?php include( get_theme_file_path() .'/templates/site-card.php' ); ?>
            </div>
        <?php endif; endwhile; endif; wp_reset_query(); ?>
        </div>   
<?php } 
function fav_con_tab($category,$id,$pname = "") { 
        $_mid = '';$i_menu = 0;?>
        <?php if( $pname != "" && io_get_option("tab_p_n") ){ ?>
        <h4 class="text-gray text-lg">
            <i class="site-tag iconfont icon-tag icon-lg mr-1" id="cat-<?php echo $mid->term_id; ?>"></i>
            <?php echo $pname; ?>
        </h4>
        <?php } ?>
        <div class="d-flex flex-fill flex-tab">
            <?php if( $pname != "" && io_get_option("tdab_p_n")&& !wp_is_mobile() ){ ?>
            <div class="text-xs" style="padding:2px 5px;margin:6px  6px 6px 0;background:rgba(0,0,0,.1);border-radius:50px"><span style="font-size:90%"><?php echo $pname ?></span></div>
            <?php } ?>
            <div class="overflow-auto">
            <div class='slider_menu mini_tab ajax-list-home' sliderTab="sliderTab" data-id="<?php echo $id ?>">
                <ul class="nav nav-pills menu" role="tablist"> 
                    <?php foreach($category as $mid) { 
                    if($i_menu==0) $_mid = $mid;
                    ?>
                    <li class="pagenumber nav-item">
                        <a id="cat-<?php echo $mid->term_id; ?>" class="nav-link <?php echo $i_menu==0?'active':'' ?>" data-action="load_home_tab_sites" data-id="<?php echo $mid->term_id; ?>" ><?php echo $mid->name; ?></a>
                    </li>
                    <?php $i_menu++; } ?>
                </ul>
            </div>
            </div> 
            <div class="flex-fill"></div>
            <?php 
            $site_n           = io_get_option('site_n');
            $category_count   = $_mid->category_count;
            $count            = $site_n;
            if($site_n == 0)  $count = min(get_option('posts_per_page'),$category_count);
            if($site_n >= 0 && $count < $category_count){
                $link = esc_url( get_term_link( $_mid, 'favorites' ) );
                echo "<a class='btn-move tab-move text-xs ml-2' href='$link' style='line-height:34px'>more+</a>";
            }
            elseif($site_n >= 0) {
                echo "<a class='btn-move tab-move text-xs ml-2' href='#' style='line-height:34px;display:none'>more+</a>";
            }
            ?>
        </div>

        <div class="row ajax-<?php echo $id ?> mt-4" style="position: relative;">
        <?php   
        
        global $post;
        $args = array(
            'post_type'           => 'sites',        //自定义文章类型，这里为sites
            'ignore_sticky_posts' => 1,              //忽略置顶文章
            'posts_per_page'      => $site_n,        //显示的文章数量
            'meta_key'            => '_sites_order',
            'orderby'             => array( 'meta_value_num' => 'DESC', 'ID' => 'DESC' ),
            'tax_query'           => array(
                array(
                    'taxonomy' => 'favorites',       //分类法名称
                    'field'    => 'id',              //根据分类法条款的什么字段查询，这里设置为ID
                    'terms'    => $_mid->term_id,     //分类法条款，输入分类的ID，多个ID使用数组：array(1,2)
                )
            ),
        );
        $myposts = new WP_Query( $args );
        if(!$myposts->have_posts()): ?>
            <div class="col-lg-12">
                <div class="nothing mb-4">没有内容</div>
            </div>
        <?php
        elseif ($myposts->have_posts()): while ($myposts->have_posts()): $myposts->the_post(); 
            $link_url = get_post_meta($post->ID, '_sites_link', true); 
            $default_ico = get_template_directory_uri() .'/images/favicon.png';
            if(current_user_can('level_10') || !get_post_meta($post->ID, '_visible', true)):
        ?>
            <div class="url-card <?php echo io_get_option('two_columns')?"col-6":"" ?> <?php get_columns() ?> <?php echo before_class($post->ID) ?>">
            <?php include( get_theme_file_path() .'/templates/site-card.php' ); ?>
            </div>
        <?php endif; endwhile; endif; wp_reset_query(); ?>
        </div>
<?php } ?>