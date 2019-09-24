<?php
/**
Plugin Name: bobbing
Depends: oik base plugin
Plugin URI: https://www.oik-plugins.com/bobbing
Description: a sample plugin that's dependent upon oik and bbboing
Version: 1.2.2
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2012-2015 Bobbing Wide (email : herb@bobbingwide.com )

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
class bobbing {
  function uppity() {}
}

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
 * 
 * bobbing version 1.2 was dependent upon oik version 1.11
 * bobbing v1.2 is now dependent upon oik version 2.0 or higher and uses the new oik-activation code
 * bobbing v1.2.1 is now dependent upon oik version 3.0.0-alpha
 * 
 */ 
function bobbing_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_bobbing/bobbing.php", "bobbing_activation" ); 
		  
    if ( !function_exists( "oik_plugin_lazy_activation" ) ) { 
			require_once( "admin/oik-activation.php" );
		} else {
			//echo "opla already active" ;
		}
  }  
  $depends = "oik:3.0.0-alpha,bbboing";
  //bw_backtrace();
	//echo "calling opla with $depends";
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
 * Implement "rightnow_end" action for bobbing 
 */ 
function bobbing_rightnow_end() {
  e( "Bobbing right now" );
  bw_flush();
} 

/**
 * Function to invoke when bobbing is loaded 
 */
function bobbing_loaded() {
  add_action( "oik_loaded", "bobbing_init" );
  add_action( "admin_notices", "bobbing_activation" );
  add_action( "oik_admin_menu", "bobbing_admin_menu" );
  add_action( "rightnow_end", "bobbing_rightnow_end" );
}

bobbing_loaded();  

  

