<?php

/**
 * Education post type
 *
 * @link       https://github.com/gmarokov/mvp-widgets-plugin
 * @since      0.1
 *
 * @package    Mvp_Widgets
 * @subpackage Mvp_Widgets/includes
 */


$labels = array(
    'name'                  => _x( 'Education', 'Post Type General Name', 'mvp-widgets' ),
    'singular_name'         => _x( 'Education', 'Post Type Singular Name', 'mvp-widgets' ),
    'menu_name'             => __( 'Education', 'mvp-widgets' ),
    'name_admin_bar'        => __( 'Education', 'mvp-widgets' ),
    'archives'              => __( 'Item Archives', 'mvp-widgets' ),
    'attributes'            => __( 'Item Attributes', 'mvp-widgets' ),
    'parent_item_colon'     => __( 'Parent Item:', 'mvp-widgets' ),
    'all_items'             => __( 'All Items', 'mvp-widgets' ),
    'add_new_item'          => __( 'Add New Item', 'mvp-widgets' ),
    'add_new'               => __( 'Add New', 'mvp-widgets' ),
    'new_item'              => __( 'New Item', 'mvp-widgets' ),
    'edit_item'             => __( 'Edit Item', 'mvp-widgets' ),
    'update_item'           => __( 'Update Item', 'mvp-widgets' ),
    'view_item'             => __( 'View Item', 'mvp-widgets' ),
    'view_items'            => __( 'View Items', 'mvp-widgets' ),
    'search_items'          => __( 'Search Item', 'mvp-widgets' ),
    'not_found'             => __( 'Not found', 'mvp-widgets' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'mvp-widgets' ),
    'featured_image'        => __( 'Featured Image', 'mvp-widgets' ),
    'set_featured_image'    => __( 'Set featured image', 'mvp-widgets' ),
    'remove_featured_image' => __( 'Remove featured image', 'mvp-widgets' ),
    'use_featured_image'    => __( 'Use as featured image', 'mvp-widgets' ),
    'insert_into_item'      => __( 'Insert into item', 'mvp-widgets' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'mvp-widgets' ),
    'items_list'            => __( 'Items list', 'mvp-widgets' ),
    'items_list_navigation' => __( 'Items list navigation', 'mvp-widgets' ),
    'filter_items_list'     => __( 'Filter items list', 'mvp-widgets' ),
);

$args = array(
    'label'                 => __( 'Education', 'mvp-widgets' ),
    'description'           => __( 'Education', 'mvp-widgets' ),
    'labels'                => $labels,
    'supports' => array( 
        'title',
        'editor',
        'excerpt',
        'publicize',
        'thumbnail',
        'stellar-places-location',
        'custom-fields',
        'comments'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_icon'   => 'dashicons-welcome-learn-more',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,		
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'rewrite' => array(
        'slug' => 'education',
        'with_front' => false,
    ),
);
    
register_post_type( 'mvp_education', $args );