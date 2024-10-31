<?php

function rsskp_check_page($hook) {
    global $current_screen;
    $rsskp_pages = array('king-pro-plugins_page_rsskingpro', "toplevel_page_kpp_menu");
    
    if (in_array($hook, $rsskp_pages)) return true;
    return false;
}

function rsskp_add_query_vars($aVars) {
    $aVars[] = "rsskppage";    // represents the name of the variable as shown in the URL
    return $aVars;
}
 
add_filter('query_vars', 'rsskp_add_query_vars');

// Add scripts to page
function rsskp_my_scripts_method() {
    wp_enqueue_style('rsskp_styles', plugins_url('/css/rsskp_default.css', dirname(__FILE__)));
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script(
        'rsskingpro-js',
        plugins_url('/js/rsskp-functions.js', dirname(__FILE__)),
        array('jquery')
    );
    wp_localize_script( 'rsskingpro-js', 'RsskpAjax', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ), 
        'ajaxnonce' => wp_create_nonce( 'akpN0nc3' ), 
        'pluginurl' => plugins_url('/', dirname(__FILE__))
        ) 
    );
}
add_action('wp_enqueue_scripts', 'rsskp_my_scripts_method');

// Styling for the custom post type icon
function wpt_rsskp_icons() {
    ?>
    <style type="text/css" media="screen">
        #toplevel_page_kpp_menu .wp-menu-image {
            background: url(<?= plugins_url('/images/kpp-icon_16x16_sat.png', dirname(__FILE__)) ?>) no-repeat center center !important;
        }
	#toplevel_page_kpp_menu:hover .wp-menu-image, #toplevel_page_kpp_menu.wp-has-current-submenu .wp-menu-image {
            background: url(<?= plugins_url('/images/kpp-icon_16x16.png', dirname(__FILE__)) ?>) no-repeat center center !important;
        }
	#icon-options-general.icon32-posts-kpp_menu, #icon-kpp_menu.icon32 {background: url(<?= plugins_url('/images/kpp-icon_32x32.png', dirname(__FILE__)) ?>) no-repeat;}
        
    </style>
<?php }
add_action( 'admin_head', 'wpt_rsskp_icons' );

// Add King Pro Plugins Section
if(!function_exists('find_kpp_menu_item')) {
  function find_kpp_menu_item($handle, $sub = false) {
    if(!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
      return false;
    }
    global $menu, $submenu;
    $check_menu = $sub ? $submenu : $menu;
    if(empty($check_menu)) {
      return false;
    }
    foreach($check_menu as $k => $item) {
      if($sub) {
        foreach($item as $sm) {
          if($handle == $sm[2]) {
            return true;
          }
        }
      } 
      else {
        if($handle == $item[2]) {
          return true;
        }
      }
    }
    return false;
  }
}

function rsskp_add_parent_page() {
  if(!find_kpp_menu_item('kpp_menu')) {
    add_menu_page('King Pro Plugins','King Pro Plugins', 'manage_options', 'kpp_menu', 'kpp_menu_page');
  }
//  if(!function_exists('remove_submenu_page')) {
//    unset($GLOBALS['submenu']['kpp_menu'][0]);
//  }
//  else {
//    remove_submenu_page('kpp_menu','kpp_menu');
//  }
  
  add_submenu_page('kpp_menu', 'RSS King Pro', 'RSS King Pro', 'manage_options', 'rsskingpro', 'rsskp_settings_output');
}
add_action('admin_menu', 'rsskp_add_parent_page');

function rsskp_enqueue($hook) {
    if (rsskp_check_page($hook)) :
        wp_register_style( 'rsskp_css', plugins_url('css/rsskingpro-styles.css', dirname(__FILE__)), false, '1.0.0' ); 
        wp_register_style( 'fontawesome', plugins_url('css/font-awesome.min.css', dirname(__FILE__)), false, '3.2.1');
        
        wp_enqueue_style( 'rsskp_css' );
        wp_enqueue_style( 'fontawesome' );
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        endif;
}
add_action( 'admin_enqueue_scripts', 'rsskp_enqueue' );

if(!function_exists('kpp_menu_page')) {
    function kpp_menu_page() {
        include 'screens/kpp.php';
    }
}

function rsskp_settings_output() {
    include 'screens/settings.php';
} 
?>