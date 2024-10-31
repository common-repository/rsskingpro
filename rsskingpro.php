<?php
/*
    Plugin Name: RSS King Pro
    Plugin URI: http://kingpro.me/plugins/rss-king-pro/
    Description: RSS King Pro allows you display and format a RSS feed on a page
    Version: 1.0.9
    Author: Ash Durham
    Author URI: http://durham.net.au/
    License: GPL2

    Copyright 2013  Ash Durham  (email : plugins@kingpro.me)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// INSTALL

    global $rsskp_db_version;
    $rsskp_db_version = "1.0.9";

    function rsskp_install() {
       global $wpdb;
       global $rsskp_db_version;

       require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
       
       add_option("rsspk_db_version", $rsskp_db_version);
    }
    
    // Register hooks at activation
    register_activation_hook(__FILE__,'rsskp_install');
    
    // END INSTALL
    
    if (get_option("rsspk_db_version") != $rsskp_db_version) {
        // Execute your upgrade logic here
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Then update the version value
        update_option("rsspk_db_version", $rsskp_db_version);
    }
    
    function rsskp_settings_link($action_links,$plugin_file){
            if($plugin_file==plugin_basename(__FILE__)){
                    $rsskp_settings_link = '<a href="admin.php?page=' . str_replace('-', '', dirname(plugin_basename(__FILE__))) . '">' . __("Settings") . '</a>';
                    array_unshift($action_links,$rsskp_settings_link);
            }
            return $action_links;
    }
    add_filter('plugin_action_links','rsskp_settings_link',10,2);
    
    require_once plugin_dir_path(__FILE__).'includes/admin_area.php';
    require_once plugin_dir_path(__FILE__).'includes/output.php';
    require_once plugin_dir_path(__FILE__).'includes/widget.php';

?>