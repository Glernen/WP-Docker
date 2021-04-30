<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
 
		<?php if ( ! dynamic_sidebar( 'sidebar-bull' ) ) : ?> 
			<div id="add-widgets" class="card widget_text bk">
				
				<div class="card-header">
					<span><i class="iconfont icon-category mr-2"></i>添加小工具</span>
				</div>
				<div class="card-body text-sm">
					<a href="<?php echo admin_url(); ?>widgets.php" target="_blank">点此为“公告侧边栏”添加小工具</a>
				</div>
			</div>
		<?php endif; ?>
 