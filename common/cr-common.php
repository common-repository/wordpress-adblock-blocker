<?php

/*
	/--------------------------------------------------------------------\
	|																	|
	| License: GPL													|
	|																	|
	| Copyright ( C ) 2010, Hors Hipsrectors								|
	| http://www.horshipsrectors.ca										|
	| All rights reserved.											|
	|																	|
	| This program is free software; you can redistribute it and/or	|
	| modify it under the terms of the GNU General Public License		|
	| as published by the Free Software Foundation; either version 2	|
	| of the License, or ( at your option ) any later version.			|
	|																	|
	| This program is distributed in the hope that it will be useful,	|
	| but WITHOUT ANY WARRANTY; without even the implied warranty of	|
	| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the	|
	| GNU General Public License for more details.					|
	|																	|
	| You should have received a copy of the GNU General Public License  |
	| along with this program; if not, write to the					|
	| Free Software Foundation, Inc.									|
	| 51 Franklin Street, Fifth Floor									|
	| Boston, MA  02110-1301, USA										|
	|																	|
	\--------------------------------------------------------------------/
*/


/*

	version: 0.0.1

*/




global $hipsrectors_wp_ab_admin_level;
global $hipsrectors_wp_ab_file_name;
global $hipsrectors_wp_ab_slug_name;
global $hipsrectors_wp_ab_admin_menu;

global $hipsrectors_common_wp_head;

add_filter( 'plugin_action_links', 'cr_wp_ab_admin_action' , - 10, 2 );
add_action( 'admin_menu', 'cr_wp_ab_admin_menu' );
add_action( 'admin_head', 'cr_wp_ab_admin_header' );
add_action( 'admin_head', 'cr_wp_ab_activation' );
add_action( 'wp_head', 'cr_wp_ab_header_code' );
add_action( 'wp_footer', 'cr_wp_ab_footer_code' );


if ( get_option( 'cr_wp_ab_dashboard_feed' ) == 'true' ) {add_action( 'wp_dashboard_setup', 'cr_wp_ab_add_dashboard_widgets' );}







function horshipsrectors_wp_ab_admin_action( $links, $file ) {

	// constructs the admin plugin menu and adds links to the plugins page

	global $hipsrectors_wp_ab_docs;
	global $hipsrectors_wp_ab_forum;
	global $hipsrectors_wp_ab_donate;
	global $hipsrectors_wp_ab_file_name;


	$this_plugin = $hipsrectors_wp_ab_file_name."/".$hipsrectors_wp_ab_file_name.".php";

	if ( $file == $this_plugin ) {

		if ( $hipsrectors_wp_ab_docs ) {$links [] = "<a href='".$hipsrectors_wp_ab_docs ."?".get_bloginfo( 'url' )."'>Docs</a>";}
		if ( $hipsrectors_wp_ab_forum ) {$links [] = "<a href='".$hipsrectors_wp_ab_forum ."?".get_bloginfo( 'url' )."'>Forum</a>";}
		if ( $hipsrectors_wp_ab_donate ) {$links [] = "<a href='".$hipsrectors_wp_ab_donate ."?".get_bloginfo( 'url' )."'>Donate</a>";}

	}
	return $links;

}









function horshipsrectors_wp_ab_admin_menu() {

	// adds the plugin menu to WordPress

	global $hipsrectors_wp_ab_name;
	global $hipsrectors_wp_ab_slug_name;
	global $hipsrectors_wp_ab_admin_level;
	global $hipsrectors_wp_ab_admin_menu;


	if ( strlen( get_option( $hipsrectors_wp_ab_slug_name.'_menu_location' ) )>0 ) {$hipsrectors_wp_ab_admin_menu = get_option( $hipsrectors_wp_ab_slug_name.'_menu_location' );}
	$hipsrectors_wp_ab_function = $hipsrectors_wp_ab_slug_name."_option";
	if ( $hipsrectors_wp_ab_admin_menu == 'dashboard' )	{add_dashboard_page		( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'posts' )		{add_posts_page			( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'media' )		{add_media_page			( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'links' )		{add_links_page			( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'comments' )	{add_comments_page		( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'theme' )		{add_theme_page			( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'plugins' )	{add_plugins_page		( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'users' )		{add_users_page			( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'tools' )		{add_management_page	( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}
	if ( $hipsrectors_wp_ab_admin_menu == 'options' )	{add_options_page		( $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_name, $hipsrectors_wp_ab_admin_level,$hipsrectors_wp_ab_slug_name, $hipsrectors_wp_ab_function );}

}












function horshipsrectors_wp_ab_dashboard_widget_function() {

	global $hipsrectors_wp_ab_slug_name;

	echo "<ul>";
	echo horshipsrectors_wp_ab_fetch_rss( $link = "http://feeds.feedburner.com/horshipsrectors?format=xml",$max=5,$format='list' );
	echo "</ul>";
}







function horshipsrectors_wp_ab_add_dashboard_widgets() {
	global $hipsrectors_wp_ab_name;
	wp_add_dashboard_widget( 'cr_wp_ab_dashboard_widget', $hipsrectors_wp_ab_name.' Plugin Updates', 'cr_wp_ab_dashboard_widget_function' );
}








function horshipsrectors_wp_ab_activation() {
	// test to see if the plugin has alreasy set the settings
	global $hipsrectors_wp_ab_slug_name;
	global $hipsrectors_wp_ab_admin_level;
	global $hipsrectors_wp_ab_admin_menu;

	$testoptions = get_option( $hipsrectors_wp_ab_slug_name.'_menu_location' );
	if ( strlen( $testoptions ) == 0 ) {
		// Install plugin

		update_option( $hipsrectors_wp_ab_slug_name.'_promos',			'true' );
		update_option( $hipsrectors_wp_ab_slug_name.'_credit',			'false' );
		update_option( $hipsrectors_wp_ab_slug_name.'_dashboard_feed',	'false' );
		update_option( $hipsrectors_wp_ab_slug_name.'_access',			$hipsrectors_wp_ab_admin_level );
		update_option( $hipsrectors_wp_ab_slug_name.'_menu_location',	$hipsrectors_wp_ab_admin_menu );

	}
}






function horshipsrectors_wp_ab_footer_code( $options='' ) {

	// run this check in the footer of the website

	global $hipsrectors_wp_ab_slug_name;
	global $hipsrectors_wp_ab_name;

	// add credit link
	if ( get_option( $hipsrectors_wp_ab_slug_name.'_credit' ) == 'true' ) {
		echo "<p><a href='".cr_wp_ab_fetch_rss( 'http://feeds.feedburner.com/horshipsrectors?format=xml',1,'url' )."'>$hipsrectors_wp_ab_name by Hors Hipsrectors</a></p>";
	} else {
		echo "<!--  $hipsrectors_wp_ab_name by Hors Hipsrectors - ".cr_wp_ab_fetch_rss( 'http://feeds.feedburner.com/horshipsrectors?format=xml',1,'url' )." -->";
	}
}

function horshipsrectors_wp_ab_header_code( $options='' ) {

}










function horshipsrectors_wp_ab_fetch_rss( $link = "http://feeds.feedburner.com/horshipsrectors?format=xml",$max=10,$format='url' ) {

	// RSS feed for plugins

	$rss = fetch_feed( $link );
	$maxitems = $rss->get_item_quantity( 1 );
	$rss_items = $rss->get_items( 0, $max );
	if ( $maxitems > 0 ) {
		foreach ( $rss_items as $item ) {
			if ( $format == 'url' ) {$rsslinks .= $item->get_permalink().", ";}
			if ( $format == 'list' ) {$rsslinks .= "<li><a href='".$item->get_permalink()."'>".$item->get_title()."</a></li>";}
		}
	}


	if ( $format == 'url' ) {
		$rsslinks =  substr( $rsslinks, 0, strlen( $rsslinks )-2 );
		if ( substr_count( $color,"," )>0 ) {
			$lastcomma = strrpos( $rsslinks,"," );
			$rsslinks = substr_replace( $rsslinks," and",$lastcomma,1 );
		}
	}

	return $rsslinks;
}








function horshipsrectors_wp_ab_option_top() {



	// admin page for plugin

	global $hipsrectors_wp_ab_name;
	global $hipsrectors_wp_ab_url;
	global $hipsrectors_wp_ab_donate;
	global $hipsrectors_wp_ab_forum;
	global $hipsrectors_wp_ab_slug_name;
	global $updatefields;
	global $hipsrectors_wp_ab_admin_thankyou;

	// admin page top
	echo "<div class='wrap ' id='wrapper'><div id='icon-options-general' class='icon32'><br /></div>";
	echo "<h2>$hipsrectors_wp_ab_name Settings</h2>";
	echo "<form method='post' action='options.php'>";
	wp_nonce_field( 'update-options' );

	echo "<div id='cr_admin_top'>";

	if ( get_option( $hipsrectors_wp_ab_slug_name.'_promos' ) != 'false' ) {
		echo "<h3>Please Support $hipsrectors_wp_ab_name</h3>";
		echo "<p><a href='".$hipsrectors_wp_ab_url."'>".$hipsrectors_wp_ab_name."</a> is a free software package developed to help you make the most of WordPress. You can help support development of $hipsrectors_wp_ab_name and other great WordPress plugins by <a href='".$hipsrectors_wp_ab_donate."'>making a donation</a> or supporting our sponsors.</p>";
	}

	echo "</div>";

	// admin page main

	echo "<div id='cr_admin_main'>";



}



function horshipsrectors_wp_ab_option_bottom() {

	global $hipsrectors_wp_ab_file_name;
	global $hipsrectors_wp_ab_slug_name;
	global $hipsrectors_wp_ab_name;
	global $hipsrectors_wp_ab_admin_credits;
	global $updatefields;





	// display readme.txt
	echo "<div class='accordionButton'><strong>Instructions &amp; readme.txt</strong></div>";
	echo "<div class='accordionContent'><p>";
		$readme = ABSPATH ."/wp-content/plugins/".$hipsrectors_wp_ab_file_name."/readme.txt";
		$fh = fopen( $readme, 'r' );
		$theData = fread( $fh, 50000 );
		fclose( $fh );
		echo "<pre style='width: 780px;'>".wordwrap( $theData,80,"<br />" )."</pre>";
	echo "</p></div>";







	// display general settings
	echo "<div class='accordionButton'><strong>Plugin System Settings</strong></div>";
	echo "<div class='accordionContent'>";
	echo "<table class='form-table'>";


		// which menu should the plugin appear under?
		echo horshipsrectors_wp_ab_admin_build_option( "Menu Location", "_menu_location", "Settings menu location within WordPress menu structure.", "select", "dashboard|Dashboard,posts|Posts,media|Media,links|Links,comments|Comments,theme|Theme,plugins|Plugins,users|Users,tools|Tools,options|Options" );

		// security level for plugin
		echo horshipsrectors_wp_ab_admin_build_option( "Access Level", "_access", "Minimum access level for users to access this plugin settings screen.", "select", "1|1,2|2,3|3,4|4,5|5,6|6,7|7,8|8,9|9,10|Admin" );

		// include credit line
		echo horshipsrectors_wp_ab_admin_build_option( "Include Credit", "_credit", "Include a link in the footer of your website as a thank you for this plugin.", "select", "true|Yes,false|No" );

		// include promos
		echo horshipsrectors_wp_ab_admin_build_option( "Include Promotions", "_promos", "Include promotions and links in the admin settings panel.", "select", "true|Yes,false|No" );

		// include dashboard
		echo horshipsrectors_wp_ab_admin_build_option( "Include Dashbaord Feed", "_dashboard_feed", "Include a feed of updates on the dashboard.", "select", "true|Yes,false|No" );





	echo "</table>";
	echo "</div>";





	// show thank you and credits

	if ( strlen( $hipsrectors_wp_ab_admin_credits ) > 0 ) {
		echo "<div class='accordionButton'><strong>Plugin Credits</strong></div>";
		echo "<div class='accordionContent'>";

		echo $hipsrectors_wp_ab_admin_credits;

		echo "</div>";
	}







	// admin page bottom

	echo "<p class='submit'>";

	echo "<input type='hidden' name='action' value='update' />";

	$updatefields = substr( $updatefields, 0, strlen( $updatefields )-2 );

	echo "<input type='hidden' name='page_options' value='$updatefields' />  ";
	echo "<input type='submit' class='button-primary' value='Save Changes' />";

	echo "</p>";
	echo "</form>";

		echo "<hr>";

		echo "<div id='cr_admin_bottom'>";

	if ( get_option( $hipsrectors_wp_ab_slug_name.'_promos' ) != 'false' ) {
		echo "<div id='cr_admin_bottom_right'>";
		echo "<script type='text/javascript'>GA_googleFillSlot( '300x250' );</script>";
		echo "</div>";
	}
		echo "<h4>$hipsrectors_wp_ab_name Links</h4>";
		echo "<ul>";
		if ( isset( $hipsrectors_wp_ab__pro ) ) {echo "<li><a href='$hipsrectors_wp_ab_url'>Upgrade to Pro Version</a></li>";}
		echo "<li><a href='$hipsrectors_wp_ab_docs'>Documents</a></li>";
		echo "<li><a href='$hipsrectors_wp_ab_forum'>Support Forums</a></li>";
		if ( isset( $hipsrectors_wp_ab_donate ) ) {echo "<li><a href='$hipsrectors_wp_ab_donate'>Support $hipsrectors_wp_ab_name</a></li>";}
		echo "</ul>";


		echo "<h4>Recent $hipsrectors_wp_ab_name News</h4>";
		echo "<ul>".cr_wp_ab_fetch_rss( $link = "http://feeds.feedburner.com/horshipsrectors?format=xml",$max=5,$format='list' )."</ul>";

	if ( get_option( $hipsrectors_wp_ab_slug_name.'_promos' ) != 'false' ) {

		echo "<h4>Recent Posts by Hors Hipsrectors</h4>";
		echo "<ul>".cr_wp_ab_fetch_rss( $link = "http://feeds.feedburner.com/horshipsrectors?format=xml",$max=5,$format='list' )."</ul>";
	}
		echo "</div>"; // close horshipsrectors_admin_bottom

	echo "</div>"; // close wrap




}






function horshipsrectors_wp_ab_admin_build_option( $title, $slug, $desc, $type, $data ) {
	global $updatefields;
	global $hipsrectors_wp_ab_slug_name;


	if ( $type == "text" ) {
		$options  = "<input name='".$hipsrectors_wp_ab_slug_name.$slug."' id='".$hipsrectors_wp_ab_slug_name.$slug."' class='regular-text' value='".get_option( $hipsrectors_wp_ab_slug_name.$slug )."'>";
	}





	if ( $type == "select" ) {
		$options  = "<select name='".$hipsrectors_wp_ab_slug_name.$slug."' id='".$hipsrectors_wp_ab_slug_name.$slug."' class='postform' >";

		$data = explode( ",",$data );
		foreach ( $data as $line ) {
			$linedata = explode( "|",$line );
			$options .= "<option class='level-0' value='".$linedata[0]."' ";

			$current = get_option( $hipsrectors_wp_ab_slug_name.$slug );

			if ( $current == $linedata[0] ) {$options .= "selected";}

			$options .=">".$linedata[1]."</option>";
		}

		$options .= "</select>";
	}

	$updatefields .= $hipsrectors_wp_ab_slug_name.$slug.", ";


	return "<tr valign='top'>
			<th scope='row'><label for='".$hipsrectors_wp_ab_slug_name.$slug."'>$title</label></th>
			<td>
			$options
			<p>$desc</p>
			</td>
			</tr>";
}



function horshipsrectors_wp_ab_admin_header() {

	// admin header css & js for the plugin
	global $hipsrectors_wp_ab_slug_name;
	global $hipsrectors_wp_ab_file_name;
		global $hipsrectors_common_wp_head;


	if ( $hipsrectors_common_wp_head != true ) {
		$hipsrectors_common_wp_head = true;


		$url = get_option( 'siteurl' );
		$cssurl = $url . "/wp-content/plugins/".$hipsrectors_wp_ab_file_name."/common/wp-admin.css";
		$jsurl = $url . "/wp-content/plugins/".$hipsrectors_wp_ab_file_name."/common/wp-admin.js";

		echo "<link rel='stylesheet' type='text/css' href='". $cssurl ."' />";

		// google ads
		echo "	<script type='text/javascript' src='http://partner.googleadservices.com/gampad/google_service.js'></script>
				<script type='text/javascript'>GS_googleAddAdSenseService( 'ca-pub-9144171931162286' ); GS_googleEnableAllServices();</script>
				<script type='text/javascript'>GA_googleAddSlot( 'ca-pub-9144171931162286', '300x250' );</script>
				<script type='text/javascript'>GA_googleFetchAds();</script>";

		// add menus
		echo "	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
				<script type='text/javascript' src='".$jsurl."'></script>
		";
	}
}








function horshipsrectors_wp_ab_update() {

}


?>