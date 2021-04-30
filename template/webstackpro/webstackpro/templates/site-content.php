<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
            <div class="panel site-content card"> 
		        <div class="card-body">
                    <div class="panel-body my-4 ">
                    <?php while( have_posts() ): the_post();?>
                        <div class="row">
	    					<div class="col-12 col-sm-5 col-md-4 col-lg-3">
                                <?php 
                                $m_link_url  = get_post_meta(get_the_ID(), '_sites_link', true);  
                                $imgurl = get_post_meta_img(get_the_ID(), '_thumbnail', true);
                                if($imgurl == ''){
                                    if( $m_link_url != '' || ($sites_type == "sites" && $m_link_url != '') )
                                        $imgurl = (io_get_option('ico-source')['ico_url'] .format_url($m_link_url) . io_get_option('ico-source')['ico_png']);
                                    elseif($sites_type == "wechat")
                                        $imgurl = get_template_directory_uri() .'/images/qr_ico.png';
                                    else
                                        $imgurl = get_template_directory_uri() .'/images/favicon.png';
                                }
                                $sitetitle = get_the_title();
                                ?>
                                <div class="siteico">
                                    <div class="blur blur-layer" style="background: transparent url(<?php echo $imgurl ?>) no-repeat center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;animation: rotate 30s linear infinite;"></div>
                                    <img class="img-cover" src="<?php echo $imgurl ?>" alt="<?php echo $sitetitle ?>" title="<?php echo $sitetitle ?>">
                                    <div id="country" class="text-xs" style="display:none;position:absolute;color:#fff;top:10px;right:10px;transition:.3s;padding:0 5px;background:#f1404b;border-radius:20px"><i class="iconfont icon-loading icon-spin"></i></div>
                                    <?php 
	                                $like_count	= get_like(get_the_ID());
	                                $liked		= isset($_COOKIE['liked_' . get_the_ID()]) ? 'liked' : ''; 
                                    ?>
                                    <div class="tool-actions text-center mt-md-4">
                                        <a href="javascript:;" data-action="like" data-id="<?php echo get_the_ID() ?>" class=" btn btn-like btn-icon btn-light rounded-circle p-2 mx-3 mx-md-2 <?php echo $liked ?>" data-toggle="tooltip" data-placement="top" title="点赞">
                                            <span class="flex-column text-height-xs">
                                                <i class="icon-lg iconfont icon-like"></i>
                                                <small class="like-count text-xs mt-1"><?php echo $like_count ?></small>
                                            </span>
                                        </a>
                                        <a href="javascript:;" class="btn-share-toggler btn btn-icon btn-light rounded-circle p-2 mx-3 mx-md-2" data-toggle="tooltip" data-placement="top" title="浏览">
                                            <span class="flex-column text-height-xs">
                                                <i class="icon-lg iconfont icon-chakan"></i>
                                                <small class="share-count text-xs mt-1"><?php echo function_exists('the_views')? the_views(false) :  '0' ; ?></small>
                                            </span>
                                        </a> 
                                    </div>
                                </div>
	    					</div>
	    					<div class="col-12 col-sm-7 col-md-8 col-lg-5 mt-4 mt-sm-0">
	    						<div class="site-body text-sm">
                                    <?php 
                                    $terms = get_the_terms( get_the_ID(), 'favorites' ); 
                                    if( !empty( $terms ) ){
                                        foreach( $terms as $term ){
                                             if($term->parent != 0){
                                                  $parent_category = get_term( $term->parent );
                                                  echo '<a class="btn-cat mb-2" href="' . esc_url( get_category_link($parent_category->term_id)) . '">' . esc_html($parent_category->name) . ' </a>';
                                                  echo '<i class="iconfont icon-arrow-r-m mr-n1" style="font-size:50%;color:#f1404b"></i>';
                                                  break;
                                             }
                                        } 
                                    	foreach( $terms as $term ){
                                            $name = $term->name;
                                            $link = esc_url( get_term_link( $term, 'favorites' ) );
                                            echo " <a class='btn-cat mb-2' href='$link'>".$name."</a>";
                                        }
                                    }  
                                    ?>
                                    <div class="site-name h3 my-3"><?php echo $sitetitle ?></div>
                                    <div class="mt-2">
                                        <?php 
                                        $width = 150;
                                        $m_post_link_url = $m_link_url ?: get_permalink($post->ID);
                                        $qrurl = "<img src='".str_ireplace(array('$size','$url'),array($width,$m_post_link_url),io_get_option('qr_url'))."' width='{$width}'>";
                                        $qrname = "手机查看";
                                        if(get_post_meta_img(get_the_ID(), '_wechat_qr', true) || $sites_type == 'wechat'){
                                            $m_qrurl = get_post_meta_img(get_the_ID(), '_wechat_qr', true);
                                            if($m_qrurl == "")
                                                $qrurl = '<p>居然没有添加二维码</p>';
                                            else 
                                                $qrurl = "<img src='".$m_qrurl."' width='{$width}'>";
                                            $qrname = "公众号";
                                        }
                                        ?>
                                        <p class="mb-2"><?php echo htmlspecialchars(get_post_meta(get_the_ID(), '_sites_sescribe', true)) ?></p> 
                                        <?php the_terms( get_the_ID(), 'sitetag','标签：<span class="mr-1">', '</span> <span class="mr-1">', '</span>' ); ?>
	    								<div class="site-go mt-3">
                                        <?php if($m_link_url!=""): ?>
                                        <?php security_check($m_link_url) ?>
	    								<a style="margin-right: 10px;" href="<?php echo io_get_option('is_go')? '/go/?url='.base64_encode($m_link_url) : $m_link_url ?>" title="<?php echo $sitetitle ?>" target="_blank" class="btn btn-arrow"><span>链接直达<i class="iconfont icon-arrow-r-m"></i></span></a>
                                        <?php endif; ?>
                                        <a href="javascript:" class="btn btn-arrow"  data-toggle="tooltip" data-placement="bottom" title="" data-html="true" data-original-title="<?php echo $qrurl ?>"><span><?php echo $qrname ?><i class="iconfont icon-qr-sweep"></i></span></a>
                                        </div>
                                        <p id="check_s" class="text-sm" style="display:none"><i class="iconfont icon-loading icon-spin"></i></p> 
	    							</div>

	    						</div>
	    					</div>
                            <div class="col-12 col-md-12 col-lg-4 mt-4 mt-lg-0">
                                
                                <?php if(io_get_option('ad_right_s')) echo '<div class="ad ad-right">' . stripslashes( io_get_option('ad_right') ) . '</div>'; ?>
                                
                            </div>
                        </div>
                        <div class="site-content mt-4 pt-4 border-top border-color">
                            <?php  
                            $contentinfo = get_the_content();
                            if( $contentinfo ){
                                the_content();   
                            }else{
                                echo htmlspecialchars(get_post_meta(get_the_ID(), '_sites_sescribe', true));
                            }
                            ?>

                        </div>
                    <?php endwhile; ?>
                    </div>
                        <?php edit_post_link(__('编辑','i_owen'), '<span class="edit-link">', '</span>' ); ?>
                </div>
            </div>
            