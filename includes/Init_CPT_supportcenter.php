<?php
if (!defined('ABSPATH')) die('No direct access allowed');

class PE_Initializ_CTP{


  public function __construct() {
    // create custom post type unternehmen
    add_action( 'init', array($this, 'create_posttype'));
    
    //create a custom taxonomy 
    //hook into the init action and call create_xy_taxonomies when it fires
    add_action( 'init', array($this, 'create_custom_taxonomy_theme'));
  }

  function create_posttype() {

    /**
    * Register a custom post type called "Suppportcenter".
    *
    * @see get_post_type_labels() for label keys.
    */

    $labels = array(
      'name'                  => __( 'Supportcenter' ),
      'singular_name'         => __( 'supportcenter' ),
    );

    $args = array(
      'labels'             => $labels,
      'description'        => 'This is for die entries of Supportcenter Q and A.',
      'public'             => true,
      // 'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      // Default: true – set to $post_type, let it default, ‘string’ – /?{query_var_string}={single_post_slug} will work as intended.
      // 'query_var'          => false,
      // alllow rewrite, Default: true and use $post_type as slug, let it defualt
      'rewrite'            => array( 'slug' => ''),
      'capability_type'    => 'post',
      'has_archive'        => false,
      'hierarchical'       => true,
      'menu_position'      => 50, //50 – below page
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'page-attributes'),
      // 'taxonomies'         => array( 'theme' ),
      'show_in_rest'       => true // it is for gutenberg, but let it 
    );
  
    register_post_type( 'supportcenter', $args );
  }

  function create_custom_taxonomy_theme() {
    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
  
      $labels = array(
          'name' => _x( 'Theme', 'taxonomy general name' ),
          'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
          'search_items' =>  __( 'Search Theme' ),
          'all_items' => __( 'All Theme' ),
          'parent_item' => __( 'Parent Theme' ),
          'parent_item_colon' => __( 'Parent Theme:' ),
          'edit_item' => __( 'Edit Theme' ),
          'update_item' => __( 'Update Theme' ),
          'add_new_item' => __( 'Add New Theme' ),
          'new_item_name' => __( 'New Theme Name' ),
          'menu_name' => __( 'Theme' ),
      );
  
    // Now register the taxonomy
      register_taxonomy('theme',array('supportcenter'), array(
          'hierarchical' => true,
          'labels' => $labels,
          'show_ui' => true,
          'public' => true,
          'show_in_rest' => true,
          'show_admin_column' => true,
          'query_var' => true,
          'rewrite' => array( 'slug' => 'theme' ),
      ));
    }
}
