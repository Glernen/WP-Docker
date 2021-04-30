<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php 
// 兼容低版本
function get_cate_ico($class){
    if(strpos($class,' ') !== false){ 
        return $class; 
    }else{
        return 'fa '.$class; 
    }
} 
$logo_class = '';
$logo_light_class = 'class="d-none"';
if(io_get_option('theme_mode')=="io-grey-mode"){
$logo_class = 'class="logo-dark d-none"';
$logo_light_class = 'class="logo-light"';
}
?>
        <div id="sidebar" class="sticky sidebar-nav fade">
            <div class="modal-dialog h-100  sidebar-nav-inner">
                <div class="sidebar-logo border-bottom border-color">
                    <!-- logo -->
                    <div class="logo">
                        <a href="<?php bloginfo('url') ?>" class="logo-expanded">
                            <img src="<?php echo io_get_option('logo_normal_light')['url'] ?>" height="40" <?php echo $logo_light_class ?> alt="<?php bloginfo('name') ?>">
						    <img src="<?php echo io_get_option('logo_normal')['url'] ?>" height="40" <?php echo $logo_class ?> alt="<?php bloginfo('name') ?>">
                        </a>
                        <a href="<?php bloginfo('url') ?>" class="logo-collapsed">
                            <img src="<?php echo io_get_option('logo_small_light')['url'] ?>" height="40" <?php echo $logo_light_class ?> alt="<?php bloginfo('name') ?>">
						    <img src="<?php echo io_get_option('logo_small')['url'] ?>" height="40" <?php echo $logo_class ?> alt="<?php bloginfo('name') ?>">
                        </a>
                    </div>
                    <!-- logo end -->
                </div>
                <div class="sidebar-menu flex-fill">
                    <div class="sidebar-scroll" >
                        <div class="sidebar-menu-inner">
                            <ul>
                            <?php if( in_array("home",io_get_option('search_position')) ){ ?>
                                <li class="sidebar-item">
                                    <a href="<?php if (is_home() || is_front_page()): ?><?php else: ?>/<?php endif; ?>#search" class="smooth go-search-btn">
                                       <i class="iconfont icon-search icon-fw icon-lg mr-2"></i>
                                       <span>搜索</span>
                                    </a>
                                </li> 
                            <?php } 
                            foreach($categories as $category) {
                                if($category->category_parent == 0){
                                    $children = get_categories(array(
                                        'taxonomy'   => 'favorites',
                                        'meta_key'   => '_term_order',
                                        'orderby'    => 'meta_value_num',
                                        'order'      => 'desc',
                                        'child_of'   => $category->term_id,
                                        'hide_empty' => 0)
                                    );
                                    if(empty($children)){ ?>
                                    <li class="sidebar-item">
                                        <a href="<?php if (is_home() || is_front_page()): ?><?php else: ?>/<?php endif; ?>#cat-<?php echo $category->term_id;?>" class="smooth">
                                           <i class="<?php echo get_cate_ico($category->description) ?> icon-fw icon-lg mr-2"></i>
                                           <span><?php echo $category->name; ?></span>
                                        </a>
                                    </li> 
                                    <?php }else { ?>
                                    <li class="sidebar-item">
                                        <a href="javascript:;">
                                           <i class="<?php echo get_cate_ico($category->description) ?> icon-fw icon-lg mr-2"></i>
                                           <span><?php echo $category->name; ?></span>
                                           <i class="iconfont icon-arrow-r-m sidebar-more text-sm"></i>
                                        </a>
                                        <ul>
                                            <?php foreach ($children as $mid) { ?>
                                            
                                            <li>
                                                <a href="<?php if (is_home() || is_front_page()): ?><?php else: ?>/<?php endif; ?>#cat-<?php  echo $mid->term_id ;?>" class="smooth"><span><?php echo $mid->name; ?></span></a>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php }
                                } 
                            } 
                            if( io_get_option('show_friendlink') && io_get_option('links')){ ?>
                                <li class="sidebar-item">
                                    <a href="<?php if (is_home() || is_front_page()): ?><?php else: ?>/<?php endif; ?>#friendlink" class="smooth">
                                       <i class="iconfont icon-links icon-fw icon-lg mr-2"></i>
                                       <span>友情链接</span>
                                    </a>
                                </li> 
                            <?php } ?> 
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="border-top py-2 border-color">
                    <div class="flex-bottom">
                        <ul> 
                            <?php wp_menu('nav_main');?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        