<?php
if( class_exists( 'CSF' ) ) {
    $site_options = 'xyz_site_meta';
    CSF::createMetabox($site_options, array(
        'title'     => '站点信息',
        'post_type' => 'sites',
        'data_type' => 'unserialize',
        'theme'     => 'light',
    ));
    CSF::createSection($site_options, array(
        //'title'     => '站点信息',
        'fields'    => array(
			array(
			  	'id'           => '_sites_type',
			  	'type'         => 'button_set',
			  	'title'        => '类型',
			  	'options'      => array(
					'sites'  => '网站',
					'wechat' => '公众号',
					'down'   => '下载资源',
			  	),
			  	'default'      => 'sites',
			),
			array(
				'id'      => '_visible',
				'type'    => 'switcher',
				'title'   => '仅管理员可见',
				'default' => false,
			),
            array(
                'id'      => '_sites_link',
                'type'    => 'text',
                'title'   => '链接',
                'desc'    => '需要带上http://或者https://',
				'dependency' => array( '_sites_type', '!=', 'down' ),
            ),
            array(
                'id'      => '_sites_sescribe',
                'type'    => 'textarea',
                'title'   => '简介',
            ),
			array(
				'id'      => '_sites_order',
				'type'    => 'text',
				'title'   => '排序',
                'desc'    => '网址排序数值越大越靠前',
				'default' => '0',
			),
            array(
                'id'      => '_thumbnail',
                'type'    => 'media',
                'title'   => 'LOGO',
                'library' => 'image',
                'desc'    => '添加图标地址，调用自定义图标',
                //'url'     => false,
            ),
            array(
                'id'      => '_wechat_qr',
                'type'    => 'media',
                'title'   => '公众号二维码',
                //'url'     => false,
				'dependency' => array( '_sites_type', '!=', 'down' ),
            ),
            array(
                'id'      => '_sites_down',
                'type'    => 'text',
                'title'   => '下载地址',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
            array(
                'id'      => '_down_preview',
                'type'    => 'text',
                'title'   => '演示地址',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
            array(
                'id'      => '_down_formal',
                'type'    => 'text',
                'title'   => '官方地址',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
            array(
                'id'      => '_sites_password',
                'type'    => 'text',
                'title'   => '网盘密码',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
            array(
                'id'      => '_dec_password',
                'type'    => 'text',
                'title'   => '解压密码',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
            array(
                'id'      => '_down_version',
                'type'    => 'text',
                'title'   => '资源版本',
				'dependency' => array( '_sites_type', '==', 'down' ),
            ),
        )
    ) );
}