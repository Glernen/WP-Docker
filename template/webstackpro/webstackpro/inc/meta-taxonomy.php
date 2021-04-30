<?php
// 文章分类SEO设置
if( class_exists( 'CSF' ) ) {
    $prefix = 'category_meta'; 
  
    CSF::createTaxonomyOptions( $prefix, array(
        'taxonomy'  => 'category',
        'data_type' => 'serialize', 
    ) );

  
    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => '文章分类SEO设置（可留空）',
            ),
            array(
                'id'    => 'seo_title',
                'type'  => 'text',
                'title' => '自定义标题',
            ),
            array(
                'id'    => 'seo_metakey',
                'type'  => 'text',
                'title' => '设置关键词',
            ),
            array(
                'id'    => 'seo_desc',
                'type'  => 'textarea',
                'title' => '自定义描述',
            ),

        )
    ));
}

// 文章标签SEO设置
if( class_exists( 'CSF' ) ) {
    $prefix = 'post_tag_meta'; 
  
    CSF::createTaxonomyOptions( $prefix, array(
        'taxonomy'  => 'post_tag',
        'data_type' => 'serialize', 
    ) );

  
    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => '文章标签SEO设置（可留空）',
            ),
            array(
                'id'    => 'seo_title',
                'type'  => 'text',
                'title' => '自定义标题',
            ),
            array(
                'id'    => 'seo_metakey',
                'type'  => 'text',
                'title' => '设置关键词',
            ),
            array(
                'id'    => 'seo_desc',
                'type'  => 'textarea',
                'title' => '自定义描述',
            ),

        )
    ));
}
// 网址分类SEO设置
if( class_exists( 'CSF' ) ) {
    $prefix = 'favorites_options'; 
  
    CSF::createTaxonomyOptions( $prefix, array(
        'taxonomy'  => 'favorites',
        'data_type' => 'unserialize', 
    ) );

  
    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'type'    => 'notice',
                'style'   => 'danger',
                'content' => '注意，最多2级，且父级不应有内容',
            ),
            array(
                'id'      => '_term_order',
                'type'    => 'number',
                'title'   => '排序',
                'default' => 0,
                'after'   => '数字越大越靠前',
            ), 
            array(
                'type'    => 'subheading',
                'content' => '网址分类SEO设置（可留空）',
            ),
            array(
                'id'    => 'seo_title',
                'type'  => 'text',
                'title' => '自定义标题',
            ),
            array(
                'id'    => 'seo_metakey',
                'type'  => 'text',
                'title' => '设置关键词',
            ),
            array(
                'id'    => 'seo_desc',
                'type'  => 'textarea',
                'title' => '自定义描述',
            ),

        )
    ));
}

// 网址标签SEO设置
if( class_exists( 'CSF' ) ) {
    $prefix = 'sitetag_meta'; 
  
    CSF::createTaxonomyOptions( $prefix, array(
        'taxonomy'  => 'sitetag',
        'data_type' => 'serialize', 
    ) );

  
    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'type'    => 'subheading',
                'content' => '网址标签SEO设置（可留空）',
            ),
            array(
                'id'    => 'seo_title',
                'type'  => 'text',
                'title' => '自定义标题',
            ),
            array(
                'id'    => 'seo_metakey',
                'type'  => 'text',
                'title' => '设置关键词',
            ),
            array(
                'id'    => 'seo_desc',
                'type'  => 'textarea',
                'title' => '自定义描述',
            ),

        )
    ));
}