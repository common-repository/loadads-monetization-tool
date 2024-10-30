<?php

/**
 * @package LoadAds
 * @version 1.6
 */
/*
Plugin Name:       LoadAds Monetization Tool
Plugin URI:        http://loadads.com/get/p-wordpress_plugin
Description:       LoadAds plugin dedicated to maximize publishers' revenues via popunder Geo targeted Ads Serving Technology.
Version:           1.6
Author:            LoadAds.Com
Author URI:        http://loadads.com/get/p-benefit_pub
License:           GPLv2 or later
Text Domain:       loadads
*/



// .............................................................................
// adds setting link at plugin installation
// .............................................................................
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );
function add_action_links ( $links ) {
	$mylinks = array(
		'<a href="' . admin_url( 'admin.php?page=loadads-com' ) . '">Settings</a>',
	);
	return array_merge( $links, $mylinks );
}
// .............................................................................



register_activation_hook ( __FILE__, 'loadads_ok'	);
register_deactivation_hook ( __FILE__, 'loadads_ko'	);



add_option( 'LA_arr_How',	array('Earnings', 'PopUnder', 'OverLays', 'ReDirect'), '', 'yes' );
add_option( 'LA_arr_Use',	array('*', 'Yes', 'No'), '', 'yes' );



function loadads_ok()
{
	add_option( 'LA_ads_Pub',	'',		'', 'yes' );
	add_option( 'LA_ads_Api',	'',		'', 'yes' );
	add_option( 'LA_ads_How',	'',		'', 'yes' );
	add_option( 'LA_ads_Use',	'',		'', 'yes' );

	add_option( 'LA_ads_Off',	'0',	'', 'yes' );
}

function loadads_ko()
{
	delete_option( 'LA_ads_Pub' );
	delete_option( 'LA_ads_Api' );
	delete_option( 'LA_ads_How' );
	delete_option( 'LA_ads_Use' );

	delete_option( 'LA_ads_Off' );
}

function ads_Xsetting()
{
	register_setting( 'ads_opt_grp',	'LA_ads_Pub', 'LA_pubValid' );
	register_setting( 'ads_opt_grp',	'LA_ads_Api', 'LA_apiValid' );
	register_setting( 'ads_opt_grp',	'LA_ads_How', 'LA_howValid' );
	register_setting( 'ads_opt_grp',	'LA_ads_Use', 'LA_useValid' );

	register_setting( 'ads_opt_gr0',	'LA_ads_Off', 'loadads_xOK');
}

if ( is_admin() )
{
	add_action( 'admin_menu',	'ads_adm_Menu' );
	add_action( 'admin_init',	'ads_Xsetting' );

	add_action( 'wp_loaded',	'loadads_xOK' );

	function ads_adm_Menu()
	{
		add_menu_page(
						'LoadAds',
						'LoadAds.Com',
						'administrator',
						'loadads-com',
						'LA_includeT',
						'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA4RpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDY3IDc5LjE1Nzc0NywgMjAxNS8wMy8zMC0yMzo0MDo0MiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDoxMWQxYjk4Yi1iYzA4LWI0NDMtYTBmMS1kNmYxMjcyZGVmNTkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Q0ZDQ0UxMDc4NUM0MTFFN0I4RkVFRUIyMzk5RkIwNjQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Q0ZDQ0UxMDY4NUM0MTFFN0I4RkVFRUIyMzk5RkIwNjQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MDNlODg5ZjAtMDIyOS00NzRiLTkwYzUtZDBlNjYzNmYzM2U4IiBzdFJlZjpkb2N1bWVudElEPSJhZG9iZTpkb2NpZDpwaG90b3Nob3A6OTk5MmYyMjktODVjNC0xMWU3LTgzMWQtYjAxY2NlNmFlY2IyIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+/3CNSQAAAsFJREFUeNp8U1tIVFEUXffeeeJo0zCj09jLQLKfBIWECgkikiIkKMKIDBmk+rCPrEDoQR8VEvVRZBlUH5n1UxNYwRBoQUhBGjOVCcGkpoWazlMd53Fb53qbwKALa99zz957nb3X2Vfyer1Y/ERTctMSJJzXix9OmIyZDLJwc3uauLo41rDoW4lEIiGjJc8fHFcPxgstAw5TAiRYR999YggySvme/4cgkUj0ms1mXzKZdKqqWmOyr+gKZZzfHXIiS3eI2EY4iSYS7iVRVY4gm81WGY3G7pGRkYsej+e2LMtRi2Q9MZguQuXSIUBl0Cxa2UQ+k1uZdZk7guCtRhCLxR6kUqlCt9vtY/LrgoKCjkjGiopiEz4EgSdfgEPlOFlSijqMoYgkR5i2h1WsMaTT6War1fqCVexWFKXL5XJ1BAIB9AWf4rB9Bq8GFlq89g4IHkNnsQNmRLXTnxPNMvu1hcPhBovF0mO32+/E43H4/X5M/hhm8uQfiWan59BW38mVBfegoJurBsIhS5I0ZbPZ3lCDqIj0+XzQnbf05KyWBvRHkrQZQkKEtpf4KtNYZagpSTZMRFNG/JycEUni3huxIF9WSwHab9bmKCdoBZ1JTqqKuX/KVT2aMJctz5/Hvp3a7VwgruhBmtAtm4BK4fqlEZTRVhMeQzJjMDWt7PPtyPu4cZkl3KhsNbeXc3ZaXuI4AwRwaTtwSoSPETK8JNgguhVf0nhLPlzm2Gc6SjCHDpiorh2P/VT90SfgzBZglThPFD2DWsbt4mo/Mcx1maSe1Uqqoy1FGufY7Q2q/A0FHBaFuykxKJoKzYxbTRxlU+e5M0h0SurpnDDvdWXrxf9E9JAgRBnT9In5Zy2klXGX35v5rhBpfwmQIxqnfUYc0E8RN7FWnEbUMLHov38jAwrFhBFtREDfX0+M6tUp+jRoz28BBgADo/DM2C7tsAAAAABJRU5ErkJggg=='
						);
	}
}



$arrHow = get_option('LA_arr_How');
$arrUse = get_option('LA_arr_Use');
$adsPub = get_option('LA_ads_Pub');
$adsApi = get_option('LA_ads_Api');
$adsHow = get_option('LA_ads_How');
$adsUse = get_option('LA_ads_Use');
$adsOff = get_option('LA_ads_Off');



require plugin_dir_path( __FILE__ ) . 'functions.php';



// .............................................................................
// front-end monetization usage
// .............................................................................
if (get_option('LA_ads_Off') == false && isset($adsHow))
{
	switch ($adsHow)
	{
		case '1':
			add_action( 'wp_footer', 'LA_show_pop' );
			break;
		case '2':
			add_action( 'wp_footer', 'LA_show_ovr' );
			break;
		case '3':
			add_action( 'wp_footer', 'LA_show_red' );
			break;
	}
}
// .............................................................................

?>
