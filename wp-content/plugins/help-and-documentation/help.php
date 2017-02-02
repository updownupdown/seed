<?php
/* Plugin Name: Help & Documentation
 * Plugin URI: http://www.jamesc.ca
 * Description: Help and documentation for your WordPress website.
 * Version: 1.0
 * Author: James Carmichael
 * Author URI: http://www.jamesc.ca
 */

// Add menu page
add_action( 'admin_menu', 'help_menu_page' );

function help_menu_page(){
	add_menu_page( 'Help and Documentation', 'Help &amp; Docs', 'publish_pages', 'help-and-docs', 'admin_help_page', plugins_url( 'help-and-documentation/images/icon_help.png' ), 84.458 );
}


// Page Content
function echoImg($src){
	echo plugins_url( 'images/' . $src, __FILE__ );
}

function admin_help_page(){

	// Include tabs list
	include( plugin_dir_path( __FILE__ ) . 'tabs_list.php');
	?>

	<style>
		<?php include( plugin_dir_path( __FILE__ ) . 'help-style.css'); ?>
	</style>

	<div id="help-wrap" class="wrap">

		<h1>Help &amp; Documentation</h1>

		<?php
		// Get active tab
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'intro';
		?>

		<h2 class="nav-tab-wrapper">
			<?php
			// Generate tabs
			foreach($help_tabs as $tab):

				echo '<a href="?page=help-and-docs&tab=' . $tab['slug'] . '" class="nav-tab ' . ($active_tab == $tab['slug'] ? 'nav-tab-active' : '') . '">' . $tab['title'] . '</a>';

			endforeach;
			?>
		</h2>

		<?php
		// Include active tab
		$include_file = 'tab_' . $active_tab . '.php';
		$images_dir = plugin_dir_path( __FILE__ ) . '/images';


		include( plugin_dir_path( __FILE__ ) . $include_file);
		?>

	</div>

	<?php } ?>