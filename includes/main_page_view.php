
<?php
if (!defined('ABSPATH')) die('No direct access allowed');

class PE_SuppportCenter_main_view{

  public $main_page_slug;
  
  public function _contructor($slug){

    $this->$main_page_slug = $slug;

    add_filter( 'the_content', array($this, 'my_content_filter'));
  }

  function my_content_filter($content){
    
    global $post;

    if(is_page('module-verkauf')) return 'filter content' + $content;
   }
   

}