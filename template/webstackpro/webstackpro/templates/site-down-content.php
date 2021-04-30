<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php 
while( have_posts() ): the_post();                   
$name          = get_the_title();//资源名称  
$version       = get_post_meta(get_the_ID(), '_down_version', true);//当前版本
$info          = htmlspecialchars(get_post_meta(get_the_ID(), '_sites_sescribe', true));//说明与描述
$preview       = get_post_meta(get_the_ID(), '_down_preview', true);//演示地址
$formal        = get_post_meta(get_the_ID(), '_down_formal', true);//官方地址
$baidu         = get_post_meta(get_the_ID(), '_sites_down', true);//百度网盘
$baidupassword = get_post_meta(get_the_ID(), '_sites_password', true);//百度网盘密码
$decompression = get_post_meta(get_the_ID(), '_dec_password', true);//解压密码

$contentinfo   = get_the_content();

$m_link_url    = get_post_meta(get_the_ID(), '_sites_link', true);  
$imgurl        = get_post_meta_img(get_the_ID(), '_thumbnail', true);
if($imgurl == ''){
    if( $m_link_url != '' || ($sites_type == "sites" && $m_link_url != '') )
        $imgurl = (io_get_option('ico-source')['ico_url'] .format_url($m_link_url) . io_get_option('ico-source')['ico_png']);
    elseif($sites_type == "wechat")
        $imgurl = get_template_directory_uri() .'/images/qr_ico.png';
    elseif($sites_type == "down")
        $imgurl = get_template_directory_uri() .'/images/down_ico.png';
    else
        $imgurl = get_template_directory_uri() .'/images/favicon.png';
}

?>
                    
                <div class="row down-content"> 
                    <div class="col-md-12 ml-auto mr-auto ml-up">
					    <div class="card card-nav-tabs">
						    <div class="card-header text-center">
                                
                                <img class="card-header-img rounded-circle" src="<?php echo $imgurl ?>" alt="<?php echo $name ?>" title="<?php echo $name ?>">
                               
                                <p class="mb-2" style="color:#fff"><?php echo $name ?></p>
                                	<?php 
	                                $like_count	= get_like(get_the_ID());
	                                $liked		= isset($_COOKIE['liked_' . get_the_ID()]) ? 'liked' : ''; 
                                    ?>
                                    <div class="tool-actions text-center mt-md-4" style="bottom: -70px;">
                                        <a href="javascript:;" data-action="like" data-id="<?php echo get_the_ID() ?>" class=" btn btn-like btn-icon btn-light rounded-circle p-2 mx-4 mx-md-3 <?php echo $liked ?>" data-toggle="tooltip" data-placement="top" title="点赞">
                                            <span class="flex-column text-height-xs">
                                                <i class="icon-lg iconfont icon-like"></i>
                                                <small class="like-count text-xs mt-1"><?php echo $like_count ?></small>
                                            </span>
                                        </a>
                                        <a href="javascript:;" class="btn-share-toggler btn btn-icon btn-light rounded-circle p-2 mx-4 mx-md-3" data-toggle="tooltip" data-placement="top" title="浏览">
                                            <span class="flex-column text-height-xs">
                                                <i class="icon-lg iconfont icon-chakan"></i>
                                                <small class="share-count text-xs mt-1"><?php  echo function_exists('the_views')? the_views(false) :  '0' ; ?></small>
                                            </span>
                                        </a> 
                                    </div>
                               
						    </div>
						    <div class="card-body mt-5">
							    <div class="card card-signup mb-4 mb-md-5 py-3 py-md-5"> 
								    <div class="card-body card-body-up" id="card-main">
									    <div class="row">
										    <div class="col-md-12 col-lg-5 ml-auto text-sm">
												<ul class="down-info" >
													<li>
														<i class="iconfont icon-name icon-fw"></i>
														<span class="item-title">文件名称：<span>
														<?php 
														if($name){ echo $name; } ?>
													</li> 
													<li>
														<i class="iconfont icon-version icon-fw"></i>
														<span class="item-title">当前版本：</span>
														<?php
														if($version){
														echo $version;	
														}else{?>
														<span class="item-title">未添加</span>
														<?} ?>
													</li>  
												    <li>
														<i class="iconfont icon-password icon-fw"></i>
                                                        <span class="item-title">网盘密码：</span>
                                                        <?php if($baidupassword){
													        echo $baidupassword ;
                                                        } else {
													        echo '<span class="item-title">无</span>' ;
                                                        } ?>
													</li>
												    <li>
														<i class="iconfont icon-password icon-fw"></i>
                                                        <span class="item-title">解压密码：</span>
                                                        <?php if($decompression){
													        echo $decompression ;
                                                        } else {
													        echo '<span class="item-title">无</span>' ;
                                                        } ?>
													</li>
													<li>
														<i class="iconfont icon-tishi icon-fw"></i>
														<span class="item-title">附件描述：</span>
														<span style="line-height:200%">
														<?php 
														if($info){
														echo '<span class="item-title">'.$info.'</span>';	
														}else{?>
														<span class="item-title">未添加</span>	
														<?}?>
														</span>
                                                    </li>
													<li>
														<i class="iconfont icon-instructions icon-fw"></i>
														<span class="item-title">使用说明：</span>
														<span style="line-height:200%">
														<?php 
														if($contentinfo){
                                                            the_content();	
														}else{?>
														<span class="item-title">未添加</span>	
														<?}?>
														</span>
                                                    </li>
												</ul>
										    </div>
										
										    <div class="ad-bg col-md-12 col-lg-5 mr-auto mt-3 mt-lg-0">
                                            <?php if(io_get_option('ad_right_s')) echo '<div class="ad ad-right">' . stripslashes( io_get_option('ad_right') ) . '</div>'; ?>
                                            </div>
                                            
                                            
									    </div>
								    </div>
								    <div class="text-center pb-4 pb-md-3">
                                        <?php if($formal) { ?> 
									        <a class="btn btn-primary btn-round text-center mt-2" href='<?php echo $formal;?>' target="_blank">
										        <i class="iconfont icon-globe mr-2"></i>官网地址
                                            </a> 
                                        <?php }
                                        if($baidu) { ?> 
									        <a class="btn btn-primary btn-round text-center mt-2" href='<?php echo $baidu;?>' target="_blank">
										        <i class="iconfont icon-cloud-download mr-2"></i>网盘下载
                                            </a> 
										<?php } 
										if($preview) { ?> 
									        <a class="btn btn-primary btn-round text-center mt-2" href='<?php echo $preview;?>' target="_blank">
										        <i class="iconfont icon-chakan mr-2"></i>演示地址
                                            </a> 
                                        <?php } ?> 
								    </div>
                                </div> 
                                <div class="statement mb-1 py-3 px-4 px-md-5"><p></p>
                                    <i class="iconfont icon-statement icon-2x mr-2" style="vertical-align: middle;"></i><strong>声明：</strong>
				                	<div class="text-sm mt-2" style="margin-left: 39px;"><?php echo io_get_option('down_statement') ?></div>
				                </div>
						    </div> 
					    </div>
                            <?php edit_post_link(__('编辑','i_owen'), '<span class="edit-link">', '</span>' ); ?>
				    </div>  
                </div>
                <?php endwhile; ?>
