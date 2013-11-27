<?php
/**
Plugin Name: bobbing
Depends: oik base plugin
Plugin URI: http://www.oik-plugins.com/bobbing
Description: a sample plugin that's dependent upon oik and bbboing
Version: 1.2
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2012,2013 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Increment the number
 * 
 * Example of a simple function that will increment the value of a number
 * 
 * @param integer $i - the number to be incremented
 * @return integer - the incremented number
 */
function uppity( $i ) {
  $i++;
  return( $i );
}

/**
 * Implements "oik_loaded" action for bobbing  
 */
function bobbing_init( ) {
  bw_trace2();
  bw_trace2( uppity( 41 ), "the ultimate answer" );
}

/**
 * Dependency checking for bobbing
 *
 * bobbing is now dependent upon oik version 2.0 or higher and uses the new oik-activation code
 * 
 * bobbing version 1.2 was dependent upon oik version 1.11
 * 
 */ 
function bobbing_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_${plugin_basename}", __FUNCTION__ );   
    require_once( "admin/oik-activation.php" );
  }  
  $depends = "oik:2.1-alpha,bbboing";
  bw_backtrace();
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}

/**
 * Implements "oik_admin_menu" action
 * 
 * @package bobbing
 * @notes Does this tag get recognised? 
 * And how many lines does it take? 
 * Are the following tags necessary? 
 * @category action "oik_admin_menu" 
 * @uses oik_register_plugin_server
 * 
 */
function bobbing_admin_menu() {
  oik_register_plugin_server( __FILE__ );
}

/**
 * Function to invoke when bobbing is loaded 
 */
function bobbing_loaded() {
  add_action( "oik_loaded", "bobbing_init" );
  add_action( "admin_notices", "bobbing_activation" );
  add_action( "oik_admin_menu", "bobbing_admin_menu" );
}

bobbing_loaded();  

  

