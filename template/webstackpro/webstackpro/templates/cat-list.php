<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
 
					<div class="site-title mb-4">
					<?php if ( is_category() ) { ?> 
						<h4 class="text-gray text-lg mb-2">
                			<i class="site-tag iconfont icon-tag icon-lg mr-1" id="<?php single_cat_title() ?>"></i><?php single_cat_title() ?>
						</h4>
						<p class="text-secondary text-sm">
							<?php echo strip_tags(trim(category_description())); ?>
						</p>
			
					<?php } ?>
					<?php if ( is_tag() ) { ?> 
						<h4 class="text-gray text-lg mb-2">
                			<i class="site-tag iconfont icon-tag icon-lg mr-1" id="<?php single_cat_title() ?>"></i>标签：<?php single_cat_title() ?>
						</h4>
						<p class="text-secondary text-sm">
							<?php echo strip_tags(trim(tag_description())); ?>
						</p>
					<?php } ?> 
					<?php if ( is_author() ) { ?>
						<h4 class="text-gray text-lg mb-2">
                			<i class="site-tag iconfont icon-tag icon-lg mr-1"></i>作者：<?php echo get_the_author() ?>
						</h4>
						<p class="text-secondary text-sm">
							<?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我还没有学会写个人说明！'; }?>
						</p>
					<?php } ?>
					<?php if(isset($is_blog)) {

						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

						$args = array(
							'ignore_sticky_posts' => 1,
							'paged' => $paged,
						);
						query_posts( $args ); ?> 

						<h4 class="text-gray text-lg mb-2">
                			<i class="site-tag iconfont icon-tag icon-lg mr-1"></i>最新文章
						</h4>
					<?php }
					?>
					
					</div>
					<div class="cat_list">
						<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post();?>


						<div class="list-grid list-grid-padding">
							<div class="list-item card">
    							<div class="media media-3x2 rounded col-4 col-md-4">
                        			<?php if(io_get_option('lazyload')): ?>
                        			<a class="media-content" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-src="<?php echo io_get_thumbnail(array('width'=>400,'height'=>300),true) ?>"></a>
                        			<?php else: ?>
                        			<a class="media-content" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image: url(<?php echo io_get_thumbnail(array('width'=>400,'height'=>300),true) ?>);"></a>
                        			<?php endif ?>
    							</div>
    							<div class="list-content">
        							<div class="list-body">
            							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="list-title text-lg h-2x"><?php the_title(); ?></a>
            							<div class="list-desc d-none d-md-block text-sm text-secondary my-3">
                							<div class="h-2x "><?php echo preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/","",get_the_excerpt($post->ID)) ?></div>
            							</div>
        							</div>
        							<div class="list-footer">
										<div class="d-flex flex-fill align-items-center text-muted text-xs">
											<?php
        									$category = get_the_category();
        									if($category[0]){   ?>
											<span><i class="iconfont icon-classification"></i>
        										<a href="<?php echo get_category_link($category[0]->term_id ) ?>"><?php echo $category[0]->cat_name ?></a>
											</span>
        									<?php } ?>
    									 
    										<div class="flex-fill"></div>
        									<div>
                    							<time class="mx-1"><?php echo timeago( get_the_time('Y-m-d G:i:s') ) ?></time>
											</div>
										</div>        
									</div>
    							</div>
							</div>							
						</div> 
						<?php endwhile; endif;?>
					</div>
					
					<div class="posts-nav">
    	    		    <?php echo paginate_links(array(
    	    		        'prev_next'          => 0,
    	    		        'before_page_number' => '',
    	    		        'mid_size'           => 2,
						));
						?>
    	    		</div>
 