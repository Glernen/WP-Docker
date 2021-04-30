<?php if ( ! defined( 'ABSPATH' ) ) { exit; }  ?>

            <?php
            $sites_type = get_post_meta($post->ID, '_sites_type', true);
            if($post->post_type != 'sites')
                $link_url = get_permalink($post->ID);
            $title = $link_url;
            $is_html = '';
            $width = 128;
            $tooltip = 'data-toggle="tooltip" data-placement="bottom"';
            if(get_post_meta_img($post->ID, '_wechat_qr', true)){
                $title="<img src='" . get_post_meta_img(get_the_ID(), '_wechat_qr', true) . "' width='{$width}'>";
                $is_html = 'data-html="true"';
            } else {
                switch(io_get_option('po_prompt')) {
                    case 'null':  
                        $title = get_the_title();
                        $tooltip = '';
                        break;
                    case 'url': 
                        if($link_url==""){
                            if($sites_type == "down")
                                $title = '下载“'.get_the_title().'”';
                            elseif ($sites_type == "wechat") 
                                $title = '居然没有添加二维码';
                            else
                                $title = '地址错误！';
                        }
                        break;
                    case 'summary':
                        if($sites_type == "down")
                            $title = '下载“'.get_the_title().'”';
                        else
                            $title = htmlspecialchars(get_post_meta($post->ID, '_sites_sescribe', true)) ?: preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",get_the_excerpt($post->ID));
                        break;
                    case 'qr':
                        if($link_url==""){
                            if($sites_type == "down")
                                $title = '下载“'.get_the_title().'”';
                            elseif ($sites_type == "wechat") 
                                $title = '居然没有添加二维码';
                            else
                                $title = '地址错误！';
                        }
                        else{
                            $title = "<img src='".str_ireplace(array('$size','$url'),array($width,$link_url),io_get_option('qr_url'))."' width='{$width}' height='{$width}'>";
                            $is_html = 'data-html="true"';
                        }
                        break;
                    default: 
                } 
            } 
            
            $url = '';
            $blank = new_window() ;
            $is_views = '';
            if(io_get_option('details_page')){
                $url=get_permalink();
            }else{ 
                if($sites_type && $sites_type != "sites"){
                    $url=get_permalink();
                }
                elseif($link_url==""){
                    $url = 'javascript:';
                    $blank = '';
                }else{
                    $is_views = 'is-views';
                    $blank = 'target="_blank"' ;
                    if(io_get_option('is_go'))
                        $url = '/go/?url='.base64_encode($link_url) ;
                    else
                        $url = $link_url;
                }
            }
            
            if($post->post_type != 'sites')
                $ico = io_get_thumbnail(array('width'=>100,'height'=>100),true);
            else
                $ico = get_post_meta_img($post->ID, '_thumbnail', true);

            if($ico == ''){
                if( $link_url != '' || ($sites_type == "sites" && $link_url != '') )
                    $ico = (io_get_option('ico-source')['ico_url'] .format_url($link_url) . io_get_option('ico-source')['ico_png']);
                elseif($sites_type == "wechat")
                    $ico = get_template_directory_uri() .'/images/qr_ico.png';
                elseif($sites_type == "down")
                    $ico = get_template_directory_uri() .'/images/down_ico.png';
                else
                    $ico = $default_ico;
            }

            ?>
        <div class="url-body default">    
            <a href="<?php echo $url ?>" <?php echo $blank ?> data-id="<?php echo $post->ID ?>" data-url="<?php echo rtrim($link_url,"/") ?>" class="card <?php echo $is_views ?> mb-4 site-<?php echo $post->ID ?>" <?php echo $tooltip . ' ' . $is_html ?> title="<?php echo $title ?>">
                <div class="card-body">
                <div class="url-content">
                    <div class="url-img">
                        <?php if(io_get_option('lazyload')): ?>
                        <img class="rounded-circle lazy" src="<?php echo $default_ico; ?>" data-src="<?php echo $ico ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'" width="40" height="40">
                        <?php else: ?>
                        <img class="rounded-circle lazy" src="<?php echo $ico ?>" onerror="javascript:this.src='<?php echo $default_ico; ?>'" width="40" height="40">
                        <?php endif ?>
                    </div>
                    <div class="url-info">
                        <div class="text-sm overflowClip_1">
                            <strong><?php the_title() ?></strong>
                        </div>
                        <p class="overflowClip_1 text-xs"><?php echo htmlspecialchars(get_post_meta($post->ID, '_sites_sescribe', true)) ?: preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",get_the_excerpt($post->ID)); ?></p>
                    </div>
                    <!--
                    <div class="url-like"> 
                        <div class="text-muted text-xs text-center mr-1"> 
                            <?php 
				            //if( function_exists( 'the_views' ) ) { the_views( true, '<div class="views"><i class="iconfont icon-chakan"></i></div><div class="mt-n1 mb-1">','</div>' ); }
                            ?>
                            <div><i class="iconfont icon-heart"></i></div><div class="mt-n1"><?php //echo get_like(get_the_ID()) ?></div>
                        </div>
                    </div>
                        -->
                </div>
                </div>
            </a> 
            <?php if( $link_url!="" && io_get_option("togo") && io_get_option("details_page") ) { ?>
            <a href="<?php echo io_get_option('is_go')? '/go/?url='.base64_encode($link_url) : $link_url ?>" class="togo text-center text-muted" target="_blank" data-toggle="tooltip" data-placement="right" title="直达"><i class="iconfont icon-goto"></i></a>
            <?php } ?>
        </div>
              