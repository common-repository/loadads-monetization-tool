<?php

if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// .............................................................................
// removes DB options in Regular-site
// .............................................................................
delete_option('LA_arr_How');
delete_option('LA_arr_Use');
delete_option('LA_ads_Pub');
delete_option('LA_ads_Api');
delete_option('LA_ads_How');
delete_option('LA_ads_Use');
delete_option('LA_ads_Off');
// .............................................................................

// .............................................................................
// removes DB options in Multi-site
// .............................................................................
delete_site_option('LA_arr_How');
delete_site_option('LA_arr_Use');
delete_site_option('LA_ads_Pub');
delete_site_option('LA_ads_Api');
delete_site_option('LA_ads_How');
delete_site_option('LA_ads_Use');
delete_site_option('LA_ads_Off');
// .............................................................................

?>
