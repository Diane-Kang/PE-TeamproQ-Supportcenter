<?php

//Remove 'Private:' from private post title
add_filter( 'private_title_format', function ( $format ) {
  return '%s';
} );
//content customize
add_filter( 'the_content', 'supportcenter_mainpage_view' );

require_once plugin_dir_path(__FILE__) . '/ViewComponents.php';

function supportcenter_mainpage_view($content){
  global $post;
  $postId = $post->ID;
  // initialize 
  
  //only for supportcenter ctp and only for modul 
  if(is_page( 'supportcenter' )){
    $supportcenter_header = supportcenter_header();
    // breadcrumms
    $breadcrumms = supportcenter_breadcrumms(); 
    //modify the incoming content 
    $modul_ueberblick = supportcenter_module();
    $content = $supportcenter_header . $breadcrumms . $modul_ueberblick;
  } 
  return $content; 
}

function supportcenter_module(){
  $section_title = "<h2>Alle Module im Überblick</h2>";
  // Argments for the parents. 'post_parent' => 0 means no parents
  // here we find Modul
  $args = array(
    'post_type' => 'supportcenter',
    'post_parent' => 0,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    ); 
  $module = get_children( $args , OBJECT);
  $modul_list ="";
  if ( $module ) {
    foreach ( $module as $modul) {
      $postId = $modul->ID;
      $modul_list .= '
        <div class="icon-text-wrapper">      
          <a href="'. get_the_permalink($postId) .'"> 
            <div class="icon-and-capture">
              <i class="tpq-icon-font '. get_post_meta($postId, 'icon_class', true) .'"></i>
            </div>
          </a>
          <p class="modul-icon-label">'. get_the_title($postId) .'</p>
        </div>
        ';
    }
  }
  $modul_list = '<div class="module modul-icons">'. $modul_list.'</div>';

  return '<div class="module-ueberblick">' . $section_title . $modul_list .'</div>';
}
