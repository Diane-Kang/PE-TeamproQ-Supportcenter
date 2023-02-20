<?php
/*
Plugin Name: Customized Supportcenter - TeamProQ by PageEffect 
Plugin URI: 
Description: This plugin for customized supportcenter pages
Version: 0.0.0
Author URI: page-effect.com
*/

if (!defined('ABSPATH')) die('No direct access allowed');

if ( ! defined( 'PE_supportcenter_Plugin_Path' ) ) {
	define( 'PE_supportcenter_Plugin_Path', plugin_dir_path( __FILE__ ) );
}
// Supportcenter main page slug 
define( 'PE_SC_Main_Page_slug', 'supportcenter');
define( 'PE_SC_CTP_name', 'supportcenter');

//Generate new Custom type Post: supportcenter, and taxonomy[Theme]  ///////////////////
// if it is not initialized yet, then 
// if we want to update CPT property, we need to make it run again without if-consition. 
if (!(isset($initialize_ctp) && is_a($initialize_ctp, 'PE_Initializ_CTP'))) {
  require_once  PE_supportcenter_Plugin_Path . 'includes/Init_CPT_supportcenter.php';
  $initialize_ctp = new PE_Initializ_CTP();
}

// Supportcenter main page 
// require_once plugin_dir_path(__FILE__) . 'includes/Init_CreateSCmainPage.php';
// module posts 
// require_once plugin_dir_path(__FILE__) . 'includes/Init_CreateModulePosts.php';
// childern posts
// require_once plugin_dir_path(__FILE__) . 'includes/CreateChildPosts.php';
// delet all the posts with CTP:supportcenter
// $wpdb->query(
// 	$wpdb->prepare(
// 		"
//     DELETE a,b,c
//     FROM wp_posts a
//     LEFT JOIN wp_term_relationships b
//         ON (a.ID = b.object_id)
//     LEFT JOIN wp_postmeta c
//         ON (a.ID = c.post_id)
//     WHERE a.post_type = 'supportcenter';
//     ")
// );


require_once plugin_dir_path(__FILE__) . 'includes/ModulPageView.php';


class PE_style_and_js{
  public function __construct(){
    add_action( 'wp_enqueue_scripts', array($this, 'style_main'), 10, 1 );
  }

  public function style_main(){
    if(is_page( PE_SC_Main_Page_slug ) || is_singular( PE_SC_CTP_name )){
      wp_enqueue_style('supportcenter-css',  plugin_dir_url( __FILE__ ) .'includes/style.css', array(),false);
    }
    if(is_singular( PE_SC_CTP_name )){
      wp_enqueue_script('supportcenter-js',  plugin_dir_url( __FILE__ ) .'includes/js_functions.js', array(),true);
    }

  }
}
$pe_style_and_js = new PE_style_and_js();

// class Old_support_css{
//   public function __construct(){
//     add_action( 'wp_enqueue_scripts', array($this, 'old-style_main'), 10, 1 );
//   }

//   public function old_style_main(){
//     if(is_singular( 'support' )){
//       wp_enqueue_style('old-support-css',  plugin_dir_url( __FILE__ ) .'includes/old-support-style.css', array(),false);
//     }
//   }
// }
// $old_support_css = new Old_support_css();


function debugging_shortcode(){
print_r(is_singular( 'supportcenter' ) );
var_dump(is_singular( 'supportcenter' ));
return is_singular( 'supportcenter' );
}


add_shortcode('debugging_shortcode_show', 'debugging_shortcode');
// function my_content_filter($content){
//   return $content . 'filter content' ;
//  }

//  add_filter( 'the_content', 'my_content_filter');


// $supportcenter_main_slug = 'teamproq-supportcenter-pe-custom';
// // ///////////// Support Center main page view///////////////////
// require_once  PE_supportcenter_Plugin_Path . 'includes/SupportCenter_main_view.php';
// $suppportCenter_main_view = new PE_SuppportCenter_main_view($supportcenter_main_slug);
// // Before, After, elements etc  
// // add_action( 'astra_single_header_after', 'ctp_unternehmen_before_content');
// // add_action( 'astra_entry_content_after', 'after_content', 12);


// // function ctp_unternehmen_before_content() {
// //   if ( is_singular('unternehmen') ) {
// //     $branche = get_the_terms( get_the_ID(), 'branche' );
    
// //     if (! empty($branche)) {
// //       foreach($branche as $tag) {
// //         $list_branchen .= '<span>' . $tag->name . '</span>';
// //         }
// //     }

// ///////////// SupportQA Archeiv page view///////////////////
// require_once  PE_supportcenter_Plugin_Path . 'includes/SupportQA_archeiv_view.php';
// $supportQA_archeiv_view = new PE_SupportQA_archeiv_view();


// ///////////// Support Center common element over pages like breadcrumms   ///////////////////
// //'includes/SupportQA_elements.php';
