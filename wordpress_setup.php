<?php
      function _remove_script_version( $src ){ 
        $parts = explode( '?', $src ); 	
        return $parts[0]; 
      } 
      add_filter( 'script_loader_src', '_remove_script_version', 15, 1 ); 
      add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );
      
      add_action( 'init', 'disable_wp_emojicons' );
function disable_wp_emojicons() {
  //wp_deregister_style( dashicons );
  remove_action( 'appthemes_after_blog_post_title', 'jr_blog_post_meta');
  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
function disable_emojicons_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

if (!is_woocommerce() && !is_cart() && !is_checkout()) {
    remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
    remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
    remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
}
add_action( 'wp_enqueue_scripts', 'remove_default_stylesheet', 20 );
function remove_default_stylesheet() {
    wp_dequeue_style( 'animate-css' );
    wp_deregister_style( 'animate-css' );
    wp_dequeue_style( 'jquery-selectBox' );
    wp_deregister_style( 'jquery-selectBox' );    
    wp_dequeue_style( 'wcpa-frontend' );
    wp_deregister_style( 'wcpa-frontend' ); 
    wp_dequeue_style( 'wxp_front_style' );
    wp_deregister_style( 'wxp_front_style' ); 
    wp_dequeue_style( 'lambda-vc-frontend' );
    wp_deregister_style( 'lambda-vc-frontend' ); 
    if (!is_admin()) {
          wp_dequeue_style('js_composer_front');
          wp_deregister_style( 'js_composer_front' ); 
     }
}
