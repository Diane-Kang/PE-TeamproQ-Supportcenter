<?php
function get_scroll_button_html(){
  $scroll_button_html = '
    <div class="scroll-buttons">
      <button onclick="topFunction()" id="btnUP" title="Go to top">Top</button>
      <button onclick="downFunction()" id="btnDown" title="Go to dwon">down</button>
    </div>
  ';
return $scroll_button_html;
}

function supportcenter_get_childern_contents($postId){

  $args = array(
    'post_type' => 'supportcenter',
    'post_parent' => $postId,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    ); 
  $childern = get_children( $args , ARRAY_A);
  $title_list='';
  $content_list = '';
  
  if ( $childern ) {
    foreach ( $childern as $child ) {
      $title_list .= '<li><a href="#'.$child["post_name"].'">'.$child["post_title"].'</a></li>';
      $content_list .= '
      <div class="single" id ='.$child["post_name"].'>'.'
        <div class="question">'. $child["post_title"].'</div>
        <div class="answer">'.$child["post_content"].'</div>
      </div>' ;
    }
  }
  $title_list = '<div class="title-wrapper"><ul>'.$title_list.'</ul></div>';
  $content_list = '<div class="qanda-wrapper">'.$content_list.'</div>';
  
  $childern_contents = '<div class="q_and_a_contents">'.$title_list.$content_list.'</div>';
  return $childern_contents;
}


function supportcenter_modul_description($postId){            
  $icon = '<div class="icon-and-capture"><i class="tpq-icon-font '. get_post_meta($postId, 'icon_class', true) .'"></i></div>';
  $content = '<div class="modul_content">'.get_the_content($postId).'</div>';
  $modul_description_html = '<div class="modul-description">'.$icon . $content. '</div>';
  return $modul_description_html;
}


function supportcenter_header() {
  global $post;
  $postId = $post->ID;
  $header_html='';
  $supportcenter_description = '
    <h3 class="supportcenter_mainpage_content">
      '.get_the_content($postId).'
    </h3>
  ';
  $searchbox = '
    <form class="searchbox" action="#">
      <input type="search" placeholder="Wie können wir helfen?">
      <button type="submit"><i class="et-pb-icon">&#x55;</i></button>
    </form>
  ';
  $background_image = '
    <span class="bg_wrap">
      <span class="background-pattern" 
        style="
          background-image: 
            url(&quot;'.plugin_dir_url( __FILE__ ).'asset/Sechsecke.svg&quot;);">
      </span>
    </span>
  ';
  $bottom_decoration = '<div class="bottom_inside_divider"></div>';

  //only for supportcenter main  
  if( is_page('supportcenter')){
    $header_title = '
    <div class="supportcenter_title_container">
      <h1 class="entry-title">'.get_the_title($postId).'</h1>
    </div>
    ';
    $header_html=$header_title . $supportcenter_description .  $searchbox;
  } //for supportcenter ctp and only for modul
  else if((is_singular( 'supportcenter' ) && !get_post_parent($postId))){
    $header_title = '
    <div class="supportcenter_title_container">
      <h1 class="entry-title">Modul '.get_the_title($postId).'</h1>
    </div>
  ';
    $header_html = $header_title . $searchbox;
  }else {
    $header_html = "this page is not for supportcenter plugin";
  }
  // add bottom decoration 
  $header_html = $background_image . $header_html . $bottom_decoration; 

return '<div class="supportcenter_header">' . $header_html . '</div>';
}


function supportcenter_breadcrumms(){
  // this is only for the suppportcenter 
  if(!(is_singular( 'supportcenter' ) || is_page('supportcenter'))) return '';
  $breadcrumms = '<div>TeamProQ Suppportcenter</div>';
  if(is_singular('supportcenter')){
    global $post;
    $icon = '<i class="et-pb-icon">&#x35;</i>';

    $breadcrumms .= $icon .'<div> Modul '. get_the_title($post->ID). '</div>';
  }
  //wrap breadcrumms in wrapper 
  $breadcrumms = '<div class="breadcrumms">'. $breadcrumms.'</div>';
  return $breadcrumms;
}