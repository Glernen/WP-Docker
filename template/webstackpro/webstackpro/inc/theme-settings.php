<?php if ( ! defined( 'ABSPATH' )  ) { die; }
 
$prefix = 'io_get_option';

CSF::createOptions( $prefix, array(
    'framework_title' => 'CINUI Pro <small>V'.wp_get_theme()->get('Version').'</small> <span style="font-size:12px">请前往 <a href="'.get_bloginfo('url').'/wp-admin/index.php">仪表盘</a> 仔细阅读使用说明，谢谢！</span>',
    'menu_title'      => '主题设置',
    'menu_slug'       => 'theme_settings',
    'menu_position'   => 59,
    'ajax_save'       => false,
    'show_bar_menu'   => false,
    'theme'           => 'dark',
    'show_search'     => false,
    'footer_text'     => esc_html__('运行在', 'cs-framework' ).'： WordPress '. get_bloginfo('version') .' / PHP '. PHP_VERSION,
    'footer_credit'   => '感谢您使用 <a href="https://www.cinui.com/" target="_blank">CINUI原创设计</a>的WordPress主题',
));

// 所有分类ID
$cats_id = '';
$categories = get_categories(array('hide_empty' => 0)); 
foreach ($categories as $cat) {
$cats_id .= '<span style="margin-right: 15px;">'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</span>';
}
//
// 图标设置
//
CSF::createSection( $prefix, array(
  'title'        => '图标设置',
  'icon'         => 'fa fa-star',
  'description'  => '网站LOGO和Favicon设置',
  'fields'       => array(
    array(
        'id'        => 'logo_normal',
        'type'      => 'media',
        'title'     => 'Logo',
        'add_title' => '上传',
        'after'     => '<p class="cs-text-muted">'.'建议高80px',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/logo@2x.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/logo@2x.png',
        ),
    ),
    array(
        'id'        => 'logo_normal_light',
        'type'      => 'media',
        'title'     => '亮色主题Logo',
        'add_title' => '上传',
        'after'     => '<p class="cs-text-muted">'.'建议高80px',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/logo_l@2x.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/logo_l@2x.png',
        ),
    ),
    array(
        'id'        => 'logo_small',
        'type'      => 'media',
        'title'     => '方形 Logo',
        'add_title' => '上传',
        'after'     => '<p class="cs-text-muted">'.'建议 80x80',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/logo-collapsed@2x.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/logo-collapsed@2x.png',
        ),
    ),
    array(
        'id'        => 'logo_small_light',
        'type'      => 'media',
        'title'     => '亮色主题方形 Logo',
        'add_title' => '上传',
        'after'     => '<p class="cs-text-muted">'.'建议 80x80',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/logo-dark_collapsed@2x.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/logo-dark_collapsed@2x.png',
        ),
    ),
    array(
        'id'        => 'favicon',
        'type'      => 'media',
        'title'     => '上传 Favicon',
        'add_title' => '上传',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/favicon.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/favicon.png',
        ),
    ),
    array(
        'id'        => 'apple_icon',
        'type'      => 'media',
        'title'     => '上传 apple_icon',
        'add_title' => '上传',
        'default'   => array(
            'url'       => get_stylesheet_directory_uri() . '/images/app-ico.png',
            'thumbnail' => get_stylesheet_directory_uri() . '/images/app-ico.png',
        ),
    ),
  )
));

  
//
// 基础设置
//
CSF::createSection( $prefix, array(
    'title'  => '基础设置',
    'icon'   => 'fa fa-th-large',
    'fields' => array(
        array(
            'id'      => 'theme_mode',
            'type'    => 'radio',
            'title'   => '颜色主题',
            'default' => 'io-white-mode',
            'inline'  => true,
            'options' => array(
                'io-black-mode'  => '暗色',
                'io-white-mode'  => '黑白',
                'io-grey-mode'   => '亮灰'
            ),
			'after'   => __('如果在前台通过“主题切换开关”手动切换主题，此设置无效，或者清除浏览器cookie才能生效','io_setting')
        ),
        array(
            'id'      => 'details_page',
            'type'    => 'switcher',
            'title'   => '详情页',
            'subtitle'=> '启用网址详情页',
            'label'   => '关闭状态为网址块直接跳转到目标网址。',
            'after'   => '<strong>“公众号”</strong>和<strong>“下载资源”</strong>默认开启详情页，不受此选项限制。',
            'default' => false,
        ),
        array(
            'id'      => 'togo',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 直达按钮',
            'label'   => '网址块显示直达按钮',
            'default' => true,
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'show_speed',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 显示网址链接速度(死链)',
            'label'   => '在网址详情页显示目标网址的链接速度、国家地址等信息',
            'after'   => '为网址失效状态提供数据来源<br>前台 JS 检测，不影响服务器性能',
            'default' => false,
            'dependency' => array( 'details_page', '==', true )
        ),
        array(
            'id'      => 'failure_valve',
            'type'    => 'spinner',
            'title'   => ' ┗━━ 网址失效状态(死链)',
            'after'   => '详情页检测链接失败几次后提示管理员检测网址有效性<br>0为关闭提示',
            'default' => 0,
            'dependency' => array( 'details_page|show_speed', '==|==', 'true|true' )
        ),
        array(
            'id'      => 'new_window',
            'type'    => 'switcher',
            'title'   => '新标签打开内链',
            'label'   => '站点所有内部链接在新标签中打开',
            'default' => true,
        ),
        array(
            'id'      => 'post_views',
            'type'    => 'switcher',
            'title'   => '访问统计',
            'after'   => '启用前先禁用WP-PostViews插件，因为主题已经集成WP-PostViews插件',
            'label'   => '如果开启没显示数字，去后台 <a href="/wp-admin/options-general.php?page=views_options" >“设置 > 浏览计数”</a> 选项里 “恢复默认” 并保存',
            'default' => false,
        ),
        array(
            'id'      => 'views_n',
            'type'    => 'text',
            'title'   => ' ┗━━ 访问基数',
            'after'   => '<br>随机访问基数，取值范围：(0~10)*访问基数<br>设置大于0的整数启用，会导致访问统计虚假，酌情开启，关闭请填0',
            'default' => 0,
            'dependency' => array( 'post_views', '==', true )
        ),
        array(
            'id'      => 'views_r',
            'type'    => 'text',
            'title'   => ' ┗━━ 访问随机计数',
            'after'   => '<br>访问一次随机增加访问次数，比如访问一次，增加5次<br>取值范围：(1~10)*访问随机数<br>设置大于0的数字启用，可以是小数，如：0.5，但小于0.5会导致取0值<br>会导致访问统计虚假，酌情开启，关闭请填0',
            'default' => 0,
            'dependency' => array( 'post_views', '==', true )
        ),
        array(
            'id'      => 'like_n',
            'type'    => 'text',
            'title'   => '点赞基数',
            'after'   => '<br>随机点赞基数，取值范围：(0~10)*点赞基数<br>设置大于0的整数启用，会导致点赞统计虚假，酌情开启，关闭请填0',
            'default' => 0,
        ),
        array(
            'id'      => 'is_go',
            'type'    => 'switcher',
            'title'   => '内链跳转',
            'default' => false,
        ),
        array(
            'id'      => 'save_image',
            'type'    => 'switcher',
            'title'   => '本地化外链图片',
            'label'   => '自动存储外链图片到本地服务器',
            'after'   => '只支持经典编辑器<br><strong>注：</strong>使用古腾堡(区块)编辑器的请不要开启，否则无法保存文章',
            'default' => false,
        ),
        array(
            'id'      => 'lazyload',
            'type'    => 'switcher',
            'title'   => '图标懒加载',
            'label'   => '所有图片懒加载',
            'default' => false,
        ),
    )
));

//
// 首页设置
//
CSF::createSection( $prefix, array(
    'title'        => '首页设置',
    'icon'         => 'fa fa-home',
    'fields'       => array(  
        array(
            'id'      => 'po_prompt',
            'type'    => 'radio',
            'title'   => '网址块弹窗提示',
            'desc'    => '网址块默认的弹窗提示内容',
            'default' => 'url',
            'inline'  => true,
            'options' => array(
                'null'      => '无',
                'url'       => '链接',
                'summary'   => '简介',
                'qr'        => '二维码'
            ),
            'after'   => '如果网址添加了自定义二维码，此设置无效',
        ),
        array(
            'id'         => 'columns',
            'type'       => 'radio',
            'title'      => '网址列数',
            'subtitle'   => '网址块列表一行显示的个数',
            'default'    => '6',
            'inline'     => true,
            'options'    => array(
                '2'  => '2',
                '3'  => '3',
                '4'  => '4',
                '6'  => '6'
            ),
        ),
        array(
            'id'      => 'two_columns',
            'type'    => 'switcher',
            'title'   => '小屏显示两列',
            'label'   => '手机等小屏幕显示两列',
            'default' => false,
        ),
		array(
			'id'         => 'site_n',
			'type'       => 'spinner',
			'title'      => '网址数量',
            'max'        => 20,
            'min'        => -1,
            'step'       => 1,
            'default'    => -1,
            'subtitle'   => '首页分类下显示的网址数量',
            'after'      => '填写需要显示的数量。<br>-1 为显示分类下所有网址<br>&nbsp;0 为根据<a href="/wp-admin/options-reading.php">系统设置数量显示</a>',
		),
        array(
            'id'      => 'show_bulletin',
            'type'    => 'switcher',
            'title'   => '启用公告',
            'label'   => '启用自定义文章类型“公告”',
            'default' => false,
        ),
        array(
            'id'         => 'bulletin',
            'type'       => 'switcher',
            'title'      => ' ┗━━ 显示公告',
            'label'      => '在首页顶部显示公告',
            'default'    => true,
            'dependency' => array( 'show_bulletin', '==', true )
        ),
        array(
            'id'         => 'bulletin_n',
            'type'       => 'spinner',
            'title'      => ' ┗━━ 公告数量',
            'after'      => '需要显示的公告篇数',
            'max'        => 10,
            'min'        => 1,
            'step'       => 1,
            'default'    => 2,
            'dependency' => array( 'bulletin|show_bulletin', '==|==', 'true|true' )
        ),
		array(
          'id'             => 'all_bull',
          'type'           => 'select',
          'title'          => ' ┗━━ 公告归档页',
		  'after'    	   => ' 如果没有，新建页面，选择“所有公告”模板并保存。',
          'options'        => 'pages',
		  'placeholder'    => '选择公告归档页面', 
		  'dependency'     => array( 'bulletin|show_bulletin', '==|==', 'true|true' )
        ),
        array(
            'id'      => 'search_position',
            'type'    => 'checkbox',
            'title'   => '搜索位置',
            'default' => 'home',
            'inline'  => true,
            'options' => array(
                'home'      => '默认位置',
                'top'       => '头部',
                'tool'      => '页脚小工具'
            ), 
            'after'      => '默认位置在首页内容前面和分类内容前面显示搜索框',
        ),
        array(
            'id'         => 'article_module',
            'type'       => 'switcher',
            'title'      => '文章模块',
            'label'      => '头部启用文章模块',
            'default'    => false,
        ),
		array(
			'id'         => 'article_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ 幻灯片数量',
            'max'        => 10,
            'min'        => 1,
            'step'       => 1,
            'default'    => 5,
            'after'      => '显示置顶的文章，请把需要显示的文章置顶。',
            'dependency' => array( 'article_module', '==', true )
		),
        array(
            'id'          => 'two_article',
            'type'        => 'text',
            'title'       => ' ┗━━ 两篇文章',
            'after'    	  => '<br>自定义文章模块中间的两篇文章，留空则随机展示。<br>填写两个文章id，用英语逗号分开，如：11,100',
            'dependency'  => array( 'article_module', '==', true ),
        ),
		array(
          'id'             => 'blog_pages',
          'type'           => 'select',
          'title'          => ' ┗━━ 博客页面',
		  'after'    	   => ' 如果没有，新建页面，选择“博客页面”模板并保存。<br>用于最新资讯旁边的“所有”按钮。',
          'options'        => 'pages',
		  'placeholder'    => '选择一个页面', 
		  'dependency'     => array( 'article_module', '==', true )
        ),
        array(
            'id'          => 'article_not_in',
            'type'        => 'text',
            'title'       => ' ┗━━ 资讯列表排除分类',
            'after'    	  => '<br>填写分类id，用英语逗号分开，如：11,100<br>文章分类id列表：'.$cats_id,
            'dependency'  => array( 'article_module', '==', true ),
        ),
        array(
            'id'          => 'post_card_list',
            'type'        => 'text',
            'title'       => '首页显示文章分类',
            'after'    	  => '<br>在首页显示文章分类卡片<br>填写分类id，用英语逗号分开，如：11,100<br>文章分类id列表：'.$cats_id,
        ),
        array(
            'id'         => 'customize_card',
            'type'       => 'switcher',
            'title'      => '自定义网址（我的导航）',
            'label'      => '显示游客自定义网址模块，允许游客自己添加网址和记录最近点击，数据保存于游客电脑。',
            'default'    => false,
        ),
        array(
            'id'         => 'customize_d_n',
            'type'       => 'text',
            'title'      => ' ┗━━ 预设网址（我的导航）',
            'after'      => '<br>自定义网址模块添加预设网址，首页“我的导航”模块预设网址<br>例：1,22,33,44 用英语逗号分开',
            'default'    => false,
            'dependency' => array( 'customize_card', '==', true )
        ),
		array(
			'id'         => 'customize_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ 最近点击',
            'after'      => '最近点击网址记录的最大数量',
            'max'        => 50,
            'min'        => 1,
            'step'       => 1,
            'default'    => 10,
            'dependency' => array( 'customize_card', '==', true )
		),
        array(
            'id'         => 'hot_card',
            'type'       => 'switcher',
            'title'      => '热门网址',
            'label'      => '显示热门网址模块，需开启访问统计，并产生了访问和点赞数据',
            'default'    => false,
        ),
        array(
            'id'         => 'hot_card_mini',
            'type'       => 'switcher',
            'title'      => ' ┗━━  mini网址块',
            'label'      => '显示热门网址启用mini网址块',
            'default'    => false,
            'dependency' => array( 'hot_card', '==', true )
        ),
		array(
			'id'         => 'hot_n',
			'type'       => 'spinner',
			'title'      => ' ┗━━ 热门网址数量',
            'max'        => 50,
            'min'        => 1,
            'step'       => 1,
            'default'    => 10,
            'dependency' => array( 'hot_card', '==', true )
		),
        array(
            'id'      => 'tab_type',
            'type'    => 'switcher',
            'title'   => 'tab模式',
            'label'   => '首页使用标签模式展示2级收藏网址',
            'default' => false,
        ),
        array(
            'id'      => 'tab_p_n',
            'type'    => 'switcher',
            'title'   => '父级名称',
            'label'   => '网址块分类名前面显示父级分类名称',
            'default' => false,
        ),
        array(
            'id'      => 'show_friendlink',
            'type'    => 'switcher',
            'title'   => '启用友链',
            'label'   => '启用自定义文章类型“链接(友情链接)”',
            'default' => false,
        ),
        array(
            'id'         => 'links',
            'type'       => 'switcher',
            'title'      => ' ┗━━ 友情链接',
            'label'      => '在首页底部添加友情链接',
            'default'    => true,
            'dependency' => array( 'show_friendlink', '==', true )
        ),
    )
));

//
// 页脚设置
//
CSF::createSection( $prefix, array(
    'title'    => '页脚设置',
    'icon'     => 'fa fa-caret-square-o-down',
    'fields'   => array( 
        array(
            'id'     => 'icp',
            'type'   => 'text',
            'title'  => '备案号',
            'dependency'  => array( 'footer_copyright', '==', '' ),
        ),

        array(
            'id'     => 'footer_copyright',
            'type'   => 'wp_editor',
            'title'  => '自定义页脚版权',
            'dependency'  => array( 'icp', '==', '' ),
        ),

        array(
            'id'      => 'down_statement',
            'type'    => 'wp_editor',
            'title'   => '下载页版权声明',
            'default' => '本站大部分下载资源收集于网络，只做学习和交流使用，版权归原作者所有。若您需要使用非免费的软件或服务，请购买正版授权并合法使用。本站发布的内容若侵犯到您的权益，请联系站长删除，我们将及时处理。',
        ),
    )
));

//
// SEO设置
//
CSF::createSection( $prefix, array(
    'title'       => 'SEO设置',
    'icon'        => 'fa fa-paw',
    'description' => '主题seo获取规则：<br>标题：页面、文章的标题<br>关键词：默认获取文章的标签，如果没有，则为标题加网址名称<br>描叙：默认获取文章简介',
    'fields'      => array(
        array(
            'id'     => 'seo_home_keywords',
            'type'   => 'text',
            'title'  => '首页关键词',
            'after'  => '<br>其他页面如果获取不到关键词，默认调取此设置',
        ),
        array(
            'id'     => 'seo_home_desc',
            'type'   => 'textarea',
            'title'  => '首页描述',
            'after'  => '<br>其他页面如果获取不到描述，默认调取此设置',
        ),
        array(
            'id'        => 'og_img',
            'type'      => 'media',
            'title'     => 'og 标签默认图片',
            'add_title' => '上传',
            'after'     => 'QQ、微信分享时显示的缩略图<br>主题会默认获取文章、网址等内容的图片，但是如果内容没有图片，则获取此设置',
        ),
    )
));
 
//
// 其他功能
//
CSF::createSection( $prefix, array(
    'title'  => '其他功能',
    'icon'   => 'fa fa-flask',
    'fields' => array(
        array(
            'id'      => 'weather',
            'type'    => 'switcher',
            'title'   => '天气',
            'label'   => '显示天气小工具',
            'default' => false,
        ),
        array(
            'id'      => 'weather_location',
            'type'    => 'radio',
            'title'   => '天气位置',
            'default' => 'footer',
            'inline'  => true,
            'options' => array(
                'header'  => '头部',
                'footer'  => '右下小工具'
            ),
            'dependency' => array( 'weather', '==', true )
        ),
        array(
            'id'      => 'hitokoto',
            'type'    => 'switcher',
            'title'   => '一言',
            'label'   => '右上角显示一言',
            'default' => false,
        ),
        array(
            'id'         => 'is_iconfont',
            'type'       => 'switcher',
            'title'      => '阿里图标',
            'label'      => 'fa 和阿里图标二选一，为轻量化资源，不能共用。',
            'default'    => false,
        ),
        array(
            'id'         => 'fa_cdn',
            'type'       => 'switcher',
            'title'      => ' ┗━━ fontawesome CDN',
            'label'      => 'fa图标库使用CDN，cdn地址修改请在 inc\register.php 文件里修改。',
            'default'    => false,
            'dependency' => array( 'is_iconfont', '==', false )
        ),
        array(
            'id'         => 'iconfont_url',  
            'type'       => 'text',
            'title'      => ' ┗━━ 阿里图标库地址',
            'desc'       => '输入图标库在线链接，图标库地址：<a href="https://www.iconfont.cn/" target="_blank">--></a><br>教程地址：<a href="https://www.iowen.cn/webstack-pro-navigation-theme-iconfont/" target="_blank">--></a>',
            'dependency' => array( 'is_iconfont', '==', true )
        ),
        array(
            'id'      => 'is_publish',
            'type'    => 'switcher',
            'title'   => '投稿直接发布',
            'label'   => '游客投稿的“网址”不需要审核直接发布',
            'default' => false,
        ),
        array(
            'id'          => 'tougao_category',
            'type'        => 'select',
            'title'       => ' ┗━━ 游客投稿分类',
            'after'       => '<br>不审核直接发布到指定分类，如果设置此项，前台投稿页的分类选择将失效。', 
            'placeholder' => '选择分类',
            'options'     => 'favorites',
            'dependency'  => array( 'is_publish', '==', true )
        ),
        array(
            'type'    => 'submessage',
            'style'   => 'danger',
            'content' => '下面的功能尽量不要动，出问题了点击上方“重置部分”重置此页设置',
        ),
        array(
            'id'      => 'ico-source',
            'type'    => 'fieldset',
            'title'   => '图标源设置',
            'subtitle'   => '自建图标源api源码地址：<a href="https://api.iowen.cn/favicon" target="_blank">--></a>',
            'fields'  => array(
                array(
                    'id'      => 'url_format',
                    'type'    => 'switcher',
                    'title'   => '不包含 http(s)://',
                    'default' => true,
                    'subtitle'    => '根据图标源 api 要求设置，如果api要求不能包含协议名称，请开启此选项',
                ),
                array(
                    'id'      => 'ico_url',
                    'type'    => 'text',
                    'title'   => '图标源',
                    'default' => 'https://api.iowen.cn/favicon/',
                    'subtitle'    => 'api 地址',
                ),
                array(
                    'id'      => 'ico_png',
                    'type'    => 'text',
                    'title'   => '图标源api后缀',
                    'default' => '.png',
                    'subtitle'=> '如：.png ,请根据api格式要求设置，如不需要请留空',
                ),
            ),
        ),
        array(
            'id'         => 'qr_url',
            'type'       => 'text',
            'title'      => '二维码api',
            'subtitle'   => '可用二维码api源地址：<a href="https://www.iowen.cn/latest-qr-code-api-service-https-available/" target="_blank">--></a>',
            'default'    => 'https://my.tv.sohu.com/user/a/wvideo/getQRCode.do?width=$size&height=$size&text=$url',
            'after'      => '<br>参数：<br>$size 大小 <br>$url  地址 <br>如：s=$size<span style="color: #ff0000;">x</span>$size 、 size=$size 、 width=$size&height=$size',
        ),
        array(
            'id'         => 'random_head_img',
            'type'       => 'textarea',
            'title'      => __('博客随机头部图片','io_setting'),
            'subtitle'   => __('缩略图、文章页随机图片','io_setting'),
            'after'      => __('一行一个图片地址，注意不要有空格','io_setting'),
            'default'    => 'https://i.loli.net/2020/01/16/uS1vfU5a3TC9kYe.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/Achos3jun7BHPYC.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/DLwVPrJq8O16dG7.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/MWBL2q7bSGl5pcz.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/6Oy5EltQCaim3R7.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/lh6mCo5IuRALM1f.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/ZB2CknpYy8zXx3c.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/SWRgep4hKOU7uac.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/95Xzaj7x4OVKqFv.jpg'.PHP_EOL.'https://i.loli.net/2020/01/16/AKv8lyzT3rUH2Ic.jpg',
        ),
    )
));

//
// 添加代码
//
CSF::createSection( $prefix, array(
    'title'       => '添加代码',
    'icon'        => 'fa fa-code',
    'fields'      => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'code_editor',
            'title'    => '自定义样式css代码',
            'subtitle' => '显示在网站头部 &lt;head&gt;',
            'after'    => '<p class="cs-text-muted">'.__('自定义 CSS,自定义美化...<br>如：','io_setting').'body .test{color:#ff0000;}<br><span style="color:#f00">注意：</span>不要填写<strong>&lt;style&gt; &lt;/style&gt;</strong></p>',
            'settings' => array(
                'tabSize' => 2,
                'theme'   => 'mbo',
                'mode'    => 'css',
            ),
        ),
        array(
            'id'       => 'code_2_footer',
            'type'     => 'code_editor',
            'title'    => 'footer自定义 js 代码',
            'subtitle' => '显示在网站底部',
            'after'    => '<p class="cs-text-muted">'.__('出现在网站底部 body 前，主要用于站长统计代码...<br><span style="color:#f00">注意：</span>必须填写<strong>&lt;script&gt; &lt;/script&gt;</strong></p>','io_setting'),
            'settings' => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
        ),
    )
));

//
// 广告位
//
CSF::createSection( $prefix, array(
    'id'    => 'add-ad',
    'title' => '添加广告',
    'icon'  => 'fa fa-google',
));
//
// 首页广告
//
CSF::createSection( $prefix, array(
    'parent'      => 'add-ad',
    'title'       => '首页广告',
    'icon'        => 'fa fa-google',
    'fields'      => array(
        array(
            'id'      => 'ad_home_s',
            'type'    => 'switcher',
            'title'   => '首页顶部广告位',
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 首页顶部广告位在移动端显示',
            'default' => false,
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 首页顶部广告位2',
            'label'   => '大屏并排显示2个广告位，小屏幕自动隐藏',
            'default' => false,
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'         => 'ad_home',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 首页顶部广告位内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s', '==', true )
        ),
        array(
            'id'         => 'ad_home2',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 首页顶部广告位2内容',
            'subtitle'   => '首页顶部第二个广告位的内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s|ad_home_s2', '==|==', 'true|true' )
        ),


        array(
            'id'      => 'ad_home_s_second',
            'type'    => 'switcher',
            'title'   => '首页网址块上方广告位',
            'label'   => '网址块上方广告位',
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile_second',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 在移动端显示',
            'default' => false,
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2_second',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 广告位2',
            'label'   => '大屏并排显示2个广告位，小屏幕自动隐藏',
            'default' => false,
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'         => 'ad_home_second',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 广告位内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s_second', '==', true )
        ),
        array(
            'id'         => 'ad_home2_second',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 广告位2内容',
            'subtitle'   => '第二个广告位的内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s_second|ad_home_s2_second', '==|==', 'true|true' )
        ),


        array(
            'id'      => 'ad_home_s_link',
            'type'    => 'switcher',
            'title'   => '友链上方广告位',
            'label'   => '首页底部友链上方广告位',
            'default' => false,
        ),
        array(
            'id'      => 'ad_home_mobile_link',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 在移动端显示',
            'default' => false,
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'      => 'ad_home_s2_link',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 友链上方广告位2',
            'label'   => '大屏并排显示2个广告位，小屏幕自动隐藏',
            'default' => false,
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'         => 'ad_home_link',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 友链上方广告位内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s_link', '==', true )
        ),
        array(
            'id'         => 'ad_home2_link',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 友链上方广告位2内容',
            'subtitle'   => '第二个广告位的内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_home_s_link|ad_home_s2_link', '==|==', 'true|true' )
        ),



        array(
            'id'      => 'ad_footer_s',
            'type'    => 'switcher',
            'title'   => 'footer 广告位',
            'label'   => '全站 footer 位广告',
            'default' => false,
        ),
        array(
            'id'         => 'ad_footer',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ footer 广告位内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_footer_s', '==', true )
        ),
    )
));
//
// 文章广告
//
CSF::createSection( $prefix, array(
    'parent'      => 'add-ad',
    'title'       => '文章广告',
    'icon'        => 'fa fa-google',
    'fields'      => array(
        array(
            'id'      => 'ad_right_s',
            'type'    => 'switcher',
            'title'   => '详情页右边广告位',
            'default' => true,
        ),
        array(
            'id'         => 'ad_right',
            'type'       => 'code_editor',
            'title'      => ' ┗━━ 详情页右边广告位内容',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/screenshot.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
			'dependency' => array( 'ad_right_s', '==', true )
        ),
        array(
            'id'         => 'ad_po',
            'type'       => 'code_editor',
            'title'      => '文章内广告短代码',
            'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
            'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
            ),
            'subtitle'   => '在文章中添加短代码 [ad] 即可调用',
        ),
		array(
			'id'         => 'ad_s_title',
			'title'      => __('正文标题广告位','io_setting'),
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_s_title_c',
			'title'      => ' ┗━━ '. __('输入正文标题广告代码','io_setting'),
			'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
			'dependency' => array( 'ad_s_title', '==', true )
		),
		array(
			'id'         => 'ad_s_b',
			'title'      => __('正文底部广告位','io_setting'),
			'default'    => '0',
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_s_b_c',
			'title'      => ' ┗━━ '. __('输入正文底部广告代码','io_setting'),
			'desc'       => '',
			'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
			'dependency' => array( 'ad_s_b', '==', true )
		),
		array(
			'id'         => 'ad_c',
			'title'      => __('评论上方广告位','io_setting'),
			'type'       => 'switcher'
		),
		array(
			'id'         => 'ad_c_c',
			'title'      => ' ┗━━ '. __('输入评论上方广告代码','io_setting'),
			'default'    => '<a href="https://www.cinui.com/" target="_blank"><img src="' . get_template_directory_uri() . '/images/ad.jpg" alt="广告也精彩" /></a>',
			'type'       => 'code_editor',
			'settings'   => array(
                'theme'  => 'dracula',
                'mode'   => 'javascript',
			),
			'dependency' => array( 'ad_c', '==', true )
		),
    )
));

//
// 优化设置
//
CSF::createSection( $prefix, array(
    'id'    => 'optimize',
    'title' => '优化设置',
    'icon'  => 'fa fa-rocket',
));
  
//
// 禁用功能
//
CSF::createSection( $prefix, array(
    'parent'      => 'optimize',
    'title'       => '禁用功能',
    'icon'        => 'fa fa-wordpress',
    'fields'      => array(

		array(
			'id'      => 'disable_rest_api',
			'type'    => 'switcher',
			'title'   => __('禁用REST API','io_setting'),
			'label'   => __('禁用REST API、移除wp-json链接（默认关闭，如果你的网站没有做小程序或是APP，建议禁用REST API）','io_setting'),
			'default' => false
		),
 
        
        array(
            'id'      => 'diable_revision',
            'type'    => 'switcher',
            'title'   => '禁用文章修订功能',
            'label'   => '禁用文章修订功能，精简 Posts 表数据。',
            'default' => false
        ),
 
        
        array(
            'id'      => 'disable_texturize',
            'type'    => 'switcher',
            'title'   => '禁用字符转码',
            'label'   => '禁用字符换成格式化的 HTML 实体功能。',
            'default' => true
        ),

		array(
			'id'      => 'disable_feed',
			'type'    => 'switcher',
			'title'   => '禁用站点Feed',
			'label'   => __('禁用站点Feed，防止文章快速被采集。','io_setting'),
			'default' => true
		),

        array(
            'id'      => 'disable_trackbacks',
            'type'    => 'switcher',
            'title'   => '禁用Trackbacks',
            'label'   => 'Trackbacks协议被滥用，会给博客产生大量垃圾留言，建议彻底关闭Trackbacks。',
            'default' => true
        ),

        array(
            'id'      => 'disable_gutenberg',
            'type'    => 'switcher',
            'title'   => '禁用古腾堡编辑器',
            'label'   => '禁用Gutenberg编辑器，换回经典编辑器。',
            'default' => true
        ),

        array(
            'id'      => 'disable_xml_rpc',
            'type'    => 'switcher',
            'title'   => ' ┗━━ 禁用XML-RPC',
            'label'   => 'XML-RPC协议用于客户端发布文章，如果你只是在后台发布，可以关闭XML-RPC功能。Gutenberg编辑器需要XML-RPC功能。',
            'default' => false,
			'dependency' => array( 'disable_gutenberg', '==', true )
        ),

        array(
            'id'      => 'disable_privacy',
            'type'    => 'switcher',
            'title'   => '禁用后台隐私（GDPR）',
            'label'   => 'GDPR（General Data Protection Regulation）是欧洲的通用数据保护条例，WordPress为了适应该法律，在后台设置很多隐私功能，如果只是在国内运营博客，可以移除后台隐私相关的页面。',
            'default' => false
        ),
        array(
            'id'      => 'emoji_switcher',
            'type'    => 'switcher',
            'title'   => '禁用emoji代码',
            'label'   => 'WordPress 为了兼容在一些比较老旧的浏览器能够显示 Emoji 表情图标，而准备的功能。',
            'default' => true
        ),
        array(
            'id'      => 'disable_autoembed',
            'type'    => 'switcher',
            'title'   => '禁用Auto Embeds',
            'label'   => '禁用 Auto Embeds 功能，加快页面解析速度。 Auto Embeds 支持的网站大部分都是国外的网站，建议禁用。',
            'default' => true
        ),
        array(
            'id'      => 'disable_post_embed',
            'type'    => 'switcher',
            'title'   => '禁用文章Embed',
            'label'   => '禁用可嵌入其他 WordPress 文章的Embed功能',
            'default' => false
        ),
    )
));

//
// 优化加速
//
CSF::createSection( $prefix, array(
    'parent'      => 'optimize',
    'title'       => '优化加速',
    'icon'        => 'fa fa-envira',
    'fields'      => array(

        array(
            'id'      => 'remove_head_links',
            'type'    => 'switcher',
            'title'   => '移除头部代码',
            'label'   => 'WordPress会在页面的头部输出了一些link和meta标签代码，这些代码没什么作用，并且存在安全隐患，建议移除WordPress页面头部中无关紧要的代码。',
            'default' => true
        ),

        array(
            'id'      => 'remove_admin_bar',
            'type'    => 'switcher',
            'title'   => '移除admin bar',
            'label'   => 'WordPress用户登陆的情况下会出现Admin Bar，此选项可以帮助你全局移除工具栏，所有人包括管理员都看不到。',
            'default' => true
        ),
		array(
			'id'      => 'ioc_category',
			'type'    => 'switcher',
			'title'   => __('去除分类标志','io_setting'),
			'label'   => __('去除链接中的分类category标志，有利于SEO优化，每次开启或关闭此功能，都需要重新保存一下固定链接！','io_setting'),
			'default' => true
		),
		array(
			'id'      => 'locale',
			'type'    => 'switcher',
			'title'   => __('前台不加载语言包','io_setting'),
			'label'   => __('前台不加载语言包，节省加载语言包所需的0.1-0.5秒。','io_setting'),
			'default' => false
		),

        array(
            'id'      => 'gravatar',
            'type'    => 'select',
            'title'   => 'Gravatar加速',
            'default' => 'garav',
            'options' => array(
                'garav'   => '使用Gravatar默认服务器',
                'v2ex'    => '使用v2ex镜像加速服务',
            ),
        ),
		array(
			'id'      => 'remove_help_tabs',
			'type'    => 'switcher',
			'title'   => __('移除帮助按钮','io_setting'),
			'label'   => __('移除后台界面右上角的帮助','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'remove_screen_options',
			'type'    => 'switcher',
			'title'   => __('移除选项按钮','io_setting'),
			'label'   => __('移除后台界面右上角的选项','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'no_admin',
			'type'    => 'switcher',
			'title'   => __('禁用 admin','io_setting'),
			'label'   => __('禁止使用 admin 用户名尝试登录 WordPress。','io_setting'),
			'default' => false
		),
		array(
			'id'      => 'compress_html',
			'type'    => 'switcher',
			'title'   => __('压缩 html 源码','io_setting'),
			'label'   => __('压缩网站源码，提高加载速度。（如果启用发现网站布局错误，请禁用。）','io_setting'),
			'default' => false
		),
    )
));
 

//
// 备份
//
CSF::createSection( $prefix, array(
    'title'       => '备份设置',
    'icon'        => 'fa fa-shield',
    'description' => '仅能保存主题设置，不能保存整站数据。（此操作可能会清除设置数据，请谨慎操作）',
    'fields'      => array( 

        // 备份
        array(
            'type' => 'backup',
        ),
    )
));

