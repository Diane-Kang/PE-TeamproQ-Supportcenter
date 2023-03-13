<?php
if (!defined('ABSPATH')) die('No direct access allowed');

class PE_Initializ_CTP{


  public function __construct() {
    // create custom post type unternehmen
    add_action( 'init', array($this, 'create_posttype'));

    // add Modul Filter
    add_filter( 'parse_query',array($this, 'cbt_admin_posts_filter'));
    add_action( 'restrict_manage_posts',array($this, 'admin_page_filter_parentpages'));
    
    // add a column to the post type's admin
    // basically registers the column and sets it's title
    $MY_POST_TYPE = 'supportcenter';
    add_filter('manage_' . $MY_POST_TYPE . '_posts_columns', function ($columns) {
      $columns['menu_order'] = "Order";
      return $columns;
    });
    // display the column value
    add_action( 'manage_' . $MY_POST_TYPE . '_posts_custom_column', function ($column_name, $post_id){
      if ($column_name == 'menu_order') {
     echo get_post($post_id)->menu_order;
      }
    }, 10, 2); // priority, number of args - MANDATORY HERE!
    // make it sortable
    $menu_order_sortable_on_screen = 'edit-' . $MY_POST_TYPE; // screen name of LIST page of posts
    add_filter('manage_' . $menu_order_sortable_on_screen . '_sortable_columns', function ($columns){
      // column key => Query variable
      // menu_order is in Query by default so we can just set it
      $columns['menu_order'] = 'menu_order';
      return $columns;
    }); 

    //create a custom taxonomy 
    //hook into the init action and call create_xy_taxonomies when it fires
    // add_action( 'init', array($this, 'create_custom_taxonomy_theme'));
  }

  function cbt_admin_posts_filter( $query ) {
    global $pagenow;
    if ( is_admin() && $pagenow == 'edit.php' && !empty($_GET['my_parent_pages'])) {
      $query->query_vars['post_parent'] = $_GET['my_parent_pages'];
    }
  }
  
  function admin_page_filter_parentpages() { 
    global $wpdb;   
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'supportcenter') {
      $sql = "SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_type = 'supportcenter' AND post_parent = 0 AND post_status = 'publish' ORDER BY post_title";
      $parent_pages = $wpdb->get_results($sql, OBJECT_K);
      $select = '
          <select name="my_parent_pages">
              <option value="">Modul</option>';
              $current = isset($_GET['my_parent_pages']) ? $_GET['my_parent_pages'] : '';
              foreach ($parent_pages as $page) {
                $select .= sprintf('
                  <option value="%s"%s>%s</option>', $page->ID, $page->ID == $current ? ' selected="selected"' : '', $page->post_title);
              }
      $select .= '
          </select>';
      echo $select;
    } else {
      return;
    }
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
      // 'rewrite'            => array( 'slug' => ''),
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

  function add_new_header_text_column($header_text_columns) {
    $header_text_columns['menu_order'] = "Order";
    return $header_text_columns;
  }
  function show_order_column($name){
    global $post;
  
    switch ($name) {
      case 'menu_order':
        $order = $post->menu_order;
        echo $order;
        break;
     default:
        break;
     }
  }

  // function create_custom_taxonomy_theme() {
  //   // Add new taxonomy, make it hierarchical like categories
  //   //first do the translations part for GUI
  
  //     $labels = array(
  //         'name' => _x( 'Theme', 'taxonomy general name' ),
  //         'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
  //         'search_items' =>  __( 'Search Theme' ),
  //         'all_items' => __( 'All Theme' ),
  //         'parent_item' => __( 'Parent Theme' ),
  //         'parent_item_colon' => __( 'Parent Theme:' ),
  //         'edit_item' => __( 'Edit Theme' ),
  //         'update_item' => __( 'Update Theme' ),
  //         'add_new_item' => __( 'Add New Theme' ),
  //         'new_item_name' => __( 'New Theme Name' ),
  //         'menu_name' => __( 'Theme' ),
  //     );
  
  //   // Now register the taxonomy
  //     register_taxonomy('theme',array('supportcenter'), array(
  //         'hierarchical' => true,
  //         'labels' => $labels,
  //         'show_ui' => true,
  //         'public' => true,
  //         'show_in_rest' => true,
  //         'show_admin_column' => true,
  //         'query_var' => true,
  //         'rewrite' => array( 'slug' => 'theme' ),
  //     ));
  //   }
}
