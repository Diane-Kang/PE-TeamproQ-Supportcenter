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

// class PE_supportcenter {


// 	public $main_page_slug = 'support';
  
//   public $support_theme_list = array();

//   public function __construct() {
    
//     global $post;

//     // not so much css and javascript// 
//     // better to here define// 

//     if('support' || child of 'supoort'){

//       wp_enqueue_script('supportcenter-js', UPDRAFTPLUS_URL."/includes/select2/select2".$min_or_not.".js", array('jquery'), $select2_version);
// 		  wp_enqueue_style('supportcenter-css', UPDRAFTPLUS_URL."/includes/select2/select2".$min_or_not.".css", array(), $select2_version);

//       if(child of 'supoort'){
//         wp_enqueue_style('supportcenter-archeive-css', UPDRAFTPLUS_URL."/includes/select2/select2".$min_or_not.".css", array(), $select2_version);
//       }
//     }
    


//   }



// }

// $pe_supportcenter = new PE_supportcenter();

///////////// Generate new Custom type Post: SuppportQA, and taxonomy[Theme]  ///////////////////
// if it is not initialized yet, then 
if (!(is_a($initialize_ctp, 'PE_Initializ_CTP'))) {
  require_once  PE_supportcenter_Plugin_Path . 'includes/supportQA_init.php';
  $initialize_ctp = new PE_Initializ_CTP();
}
// if we want to update CPT property, we need to make it run again. 


// ///////////// Support Center main page view///////////////////
// require_once  PE_supportcenter_Plugin_Path . 'includes/SupportCenter_main_view.php';
// $suppportCenter_main_view = new PE_SuppportCenter_main_view();
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








