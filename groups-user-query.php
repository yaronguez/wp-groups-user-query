<?php
/**
*
* @link              http://trestian.com
* @since             1.0.0
* @package           groupsuserquery
*
* @wordpress-plugin
* Plugin Name:       Groups User Query
* Plugin URI:        https://github.com/yaronguez/wp-groups-user-query
* Description:       Extends WP_User_Query to allow filtering by Group IDs using the Groups plugin
* Version:           1.0.0
* Author:            Yaron Guez
* Author URI:        http://trestian.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       groupsuserquery
* Domain Path:       /languages
* Github Plugin URI: https://github.com/yaronguez/wp-groups-user-query
* Github Branch: master
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function run_groupsuserquery() {
	/**
	 * The core plugin class
	 */
	require plugin_dir_path( __FILE__ ) . 'classes/class-groups-user-query.php';
	$plugin = new Trestian_Groups_User_Query();
	$plugin->run();

}
add_action('plugins_loaded', 'run_groupsuserquery');
