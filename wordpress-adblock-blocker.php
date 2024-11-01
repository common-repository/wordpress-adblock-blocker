<?php
/*
Plugin Name: WordPress AdBlock Blocker
Plugin URI:
Description: A plugin which redirects subscriber level users back to the homepage after they've logged in.
Author: Hors Hipsrectors
Author URI:
Tags: adopt-me
Version: 2017.08.13
*/

/**
 * WordPress AdBlock Blocker core file
 *
 * This file contains all the logic required for the plugin
 *
 * @link		http://wordpress.org/extend/plugins/wordpress-ablock-blocker/
 *
 * @package		WordPress AdBlock Blocker
 * @copyright		Copyright ( c ) 2017, Hors Hipsrectors
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 ( or newer )
 *
 * @since		WordPress AdBlock Blocker 1.0
 */

// add menu to WP admin

function horshipsrectors_wordpress_ad_blocker_menu( ) {

	add_options_page( 'AdBlock Blocker', 'AdBlock Blocker', 10, 'horshipsrectors_wordpress_ad_blocker.php', 'horshipsrectors_wordpress_ad_blocker_options' );

}
add_action( 'admin_menu', 'horshipsrectors_wordpress_ad_blocker_menu' );



// add plugin functions

function horshipsrectors_wordpress_ad_blocker_plugin_actions( $links, $file ) {

	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename( __FILE__ );

	if( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=horshipsrectors_wordpress_ad_blocker.php">' . __( 'Settings' ) . '</a>';
		$links = array_merge( array( $settings_link ), $links );
	}
	return $links;

}
add_filter( 'plugin_action_links', 'horshipsrectors_wordpress_ad_blocker_plugin_actions', 10, 2 );


// options page for plugin

function horshipsrectors_wordpress_ad_blocker_options( $options='' ) {

	if ( isset( $_POST['action'] ) && $_POST['action'] == 'update' )
		update_option( 'wordpress_adblock_blocker_redirect', $_POST['wordpress_adblock_blocker_redirect'] );

	$wordpress_adblock_blocker_redirect = get_option( 'wordpress_adblock_blocker_redirect' );

?>
<div class="wrap">
	<a href="http://horshipsrectors.com/"><div id="cross-icon" style="background: url( data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAA0lBMVEX///9Jj6xrpLxJj6xrpLxhnbdJj6xxqL5moblhnbdJj6xhnbdJj6xxqL5rpLxmoblJj6xxqL5hnbdJj6x1qsBJj6xrpLxmoblJj6xrpLxJj6x4rMFJj6x1qsBJj6xxqL5Jj6x4rMF1qsBxqL5Jj6z////3+vv0+Pru9ffm7/Tf6/Hd6u/V5ezS4+rO4OjG3OW71eC509+z0Nyvztuqy9ikx9aZwNCRu82OucuMtcWCssZ/sMWAsMV4rMF1qsBrpLxmoblhnbdamrRUlrFSlLBJj6wucLoaAAAAJXRSTlMAESIiMzMzRERERFVVZmZmZnd3d4iImZmZqqq7u8zM3d3u7u7u5Bc3VAAAAehJREFUOMttU9li0zAQdAkNEEoJhXIUp4HEK1vxJeLYiQ/FuGL//5dYWb5I2SdLM56dPWRZQ7z9tj5LHevPr63ncbfN9wEDCi84lNvbC/h6m0cwiShfXU/x27PQt2muM+Qpcdl+MxH5UnKAuJRDlMQPyg89/p5w7yj/iaMHvHxn8DdnTgd5EfRTtHnREtYCvBEXQc/wYL/S+LICGPUrlg1ZgJWviPBDgBiVo2D8jkGQxE0DYBJUR/1XbjCtWQKTL62vGYin9jIAP/eNWMZaXgTpJ+sxhgIbfTzoRhsBbngpxCsLOTSIWqOKQurgQVM9YyIHf2MhAFI8nSV1L9oB8KxiaWeTTPQE/FPpIbHIo3Hu+joARgLGZo47PSlRPSfIYdShTyIdwZOdSUR/XAYWc9ab/GnKRMym69J3lsr8bt2fQBAhnOBe87s+m0Zld9ZcAajBYhvSuEYFHGftsJKpRwg7HFNIbT3uxoUa8TQQmg6vwVULvRCPGXCF8S/X4EmfgEPx0G7UzInBL6nPsaa4qsN9EM6VWcolHdonk8js1OE1p+Lm/VovlWjV696eSqgZuBwfxo2TkQQvWn9NQXS3cObTpzWzVcrGSt1UPVxdvM6FjUUSkk03TAq0F/953/N729EpHPvjbLz9C0A/pR4RVDYdAAAAAElFTkSuQmCC ) no-repeat;" class="icon32"><br /></div></a>
	<h2><?php _e( 'WordPress AdBlock Blocker by Hors Hipsrectors', 'horshipsrectors_wordpress_ad_blocker' );?></h2>

	<p>The WordPress AdBlocker Blocker is designed for one purpose, to block visitors to your website who use FireFox AdBlocker.</p>

	<h3>Settings</h3>

	<form method="post" action="options-general.php?page=horshipsrectors_wordpress_ad_blocker.php"><?php wp_nonce_field( 'update-options' ); ?>

		<table class="form-table">

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="wlr_profile" />

		<tr  valign="top">
			<th scope="row">Redirect URL for Blocked Users</th>
			<td><input type="text" id="wordpress_adblock_blocker_redirect" name="wordpress_adblock_blocker_redirect" value="<?php echo $wordpress_adblock_blocker_redirect;?>" />
				<br/><em>Where would you like to redirect blocked visits? ( full URL with http:// )</em>
			</td>
		</tr>

		</table>
		<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ) ?>" /></p>
	</form>

</div>

<?php
}




add_action( 'wp_head', 'horshipsrectors_wordpress_ad_blocker_site_header_code' );


function horshipsrectors_wordpress_ad_blocker_site_header_code() {

	if( eregi( "google",$_SERVER['HTTP_USER_AGENT'] ) ) {} else {

	//$redirect_path = get_option( 'wordpress_adblock_blocker_redirect' );

	if ( empty( $redirect_path ) )
		$redirect_path = get_bloginfo( 'url' ) . '/blocked';


	if ( $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"] != $redirect_path ) {
?>
		<script type="text/javascript">
			var adblock = true;
		</script>
		<script type="text/javascript" src="<?php echo plugin_dir_url( __FILE__ ); ?>adframe.js"></script>
		<script type="text/javascript">
			if( adblock ) {
			window.location = "<?php echo $redirect_path;?>"
			}
		</script>
<?php
	}
	}
}
