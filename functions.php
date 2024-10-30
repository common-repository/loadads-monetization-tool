<?php

function loadads_xKO()
{
	if(!current_user_can( 'manage_options' ))
	return false;

	if (get_option('LA_ads_Off') == true)
	echo '
		<ul>
			<li class="list-group-item list-group-item-danger">
				Popunder code is disabled for this website.
			</li>
			<li class="list-group-item list-group-item-danger">
				<a href="./admin.php?page=loadads-com&loadads_switch=switch" class="button-primary">Enable LoadAds Earnings</a>
			</li>
		</ul>
	';
}

function loadads_xOK()
{
	if(!current_user_can( 'manage_options' ))
	return false;

	$theURL = 'admin.php?page=loadads-com&tab=';

	$switch = isset($_REQUEST['loadads_switch'])?trim($_REQUEST['loadads_switch']):'';

	if ( isset($switch) )
	{
		if ($switch == 'switch')
		{
			if (get_option('LA_ads_Off') == false)
			update_option('LA_ads_Off', true);
			else
			update_option('LA_ads_Off', false);

			wp_redirect($theURL);
			exit;
		}
	}
}

function LA_put_logo()
{
	$logo = '
			<a href="//loadads.com/pub/new_user.php" target="_blank" id="loadads_logo" title="loadads.com" style="display:inline-block;">
			<img
				style="margin:0; padding:0; max-height:40px; width:auto;"
				alt="Official LoadAds Logo"
				title="LoadAds Official Logo"
				src="' . plugins_url( 'images/logo.png', __FILE__ ) . '"
			/>
			</a>
			';
	return $logo;
}

function LA_show_pop()
{
	global $adsPub;
	if(isset($adsPub) && !empty($adsPub))
	echo '

		<!-- Start LoadAds.com PopUnder Script -->
		<script type="text/javascript">
		var pStrg = "'.$adsPub.'";
		var useLA = "under_pop";
		</script>
		<script type="text/javascript" async defer src="//loadads.com/pub/_jpopunder/popunder.js"></script>
		<!-- Stops LoadAds.com PopUnder Script -->

	';
}

function LA_show_ovr()
{
	global $adsPub;
	if(isset($adsPub) && !empty($adsPub))
	echo '

		<!-- Start LoadAds.com Overlay Script -->
		<script type="text/javascript">
		var pStrg = "'.$adsPub.'";
		var useLA = "frame_pop";
		</script>
		<script type="text/javascript" async defer src="//loadads.com/pub/_jpopunder/popunder.js"></script>
		<!-- Stops LoadAds.com Overlay Script -->

	';
}

function LA_show_red()
{
	global $adsPub;
	if(isset($adsPub) && !empty($adsPub))
	echo '

		<!-- Start LoadAds.com Redirect Script -->
		<form method="get" name="redirect" action="//loadads.com/pub/'.$adsPub.'/"></form>
		<script>
		document.forms["redirect"].submit();
		</script>
		<!-- Stops LoadAds.com Redirect Script -->

		';
}

function LA_pubValid($adsTxt)
{
	$setting = 'ads_opt_grp';
	$adsTxt = trim($adsTxt);

	if(!empty($adsTxt) && strlen($adsTxt) != 32)
	{
		if(filter_var($adsTxt, FILTER_VALIDATE_URL) && strpos($adsTxt, '//loadads.com/') !== false)
		{
			$adsTxt = strtok($adsTxt, '#');
			$adsTxt = explode('logs.php', $adsTxt);
			$adsTxt = array_shift($adsTxt);

			if(substr($adsTxt, -1) == '/'){ $adsTxt = substr($adsTxt, 0, -1); }
			$adsTxt = explode('/', $adsTxt);
			$adsTxt = array_pop($adsTxt);
		}
		else
		{
			$message = 'The string does not look like a publisher ID from loadads.com';
			add_settings_error($setting, 'pub-error', $message, 'error');

			return false;
		}
	}

	if (preg_match('/^[a-z0-9]+$/', $adsTxt) && strlen($adsTxt) == 32)
	{
		$message = 'Publisher\'s ID accepted. The publisher integration setup is ready to be used.';
		add_settings_error($setting, 'pub-success', $message, 'success');

		return $adsTxt;
	}
	else
	{
		$message = 'Publisher\'s ID isn\'t properly formatted. &nbsp; <a href="//loadads.com/pub/new_user.php" target="_blank" class="button-primary"><small>Click here to register first as a publisher at LoadAds.Com</small></a>';
		add_settings_error($setting, 'pub-error', $message, 'error');

		return false;
	}
}

function LA_apiValid($adsApi)
{
	$setting = 'ads_opt_grp';
	$adsHow = trim($adsHow);
	if(empty($adsApi))
	{
		$message = 'The API string seems empty';
		add_settings_error($setting, 'api-error', $message, 'error');
		return false;
	}
	else
	{
		if(filter_var($adsApi, FILTER_VALIDATE_URL) && strpos($adsApi, '//loadads.com/') !== false)
		{
			$arrApi = parse_url($adsApi, PHP_URL_QUERY);
			parse_str($arrApi, $arrPar);
			$adsApi = isset($arrPar['key'])?$arrPar['key']:'';
		}

		if(base64_encode(base64_decode($adsApi, true)) === $adsApi)
		{
			$message = 'The API key was stored';
			add_settings_error($setting, 'api-error', $message, 'success');
			return $adsApi;
		}
		else
		{
			$message = 'The API string isn\'t properly formatted';
			add_settings_error($setting, 'api-error', $message, 'error');
			return false;
		}
	}
}

function LA_howValid($adsHow)
{
	$setting = 'ads_opt_grp';
	$adsHow = trim($adsHow);

	if (in_array($adsHow, ['1','2','3']))
	{
		global $arrHow;

		$message = 'Usage method was stored as : '.$arrHow[$adsHow];
		add_settings_error($setting, 'how-error', $message, 'success');
		return $adsHow;
	}
	else
	{
		$message = 'Usage method isn\'t properly formatted';
		add_settings_error($setting, 'how-error', $message, 'error');
		return false;
	}
}

function LA_useValid($adsUse)
{
	$setting = 'ads_opt_grp';
	$adsUse = trim($adsUse);

	if (in_array($adsUse, ['1','2']))
	{
		global $arrUse;

		$message = 'Usage of API method was stored as : '.$arrUse[$adsUse];
		add_settings_error($setting, 'use-error', $message, 'success');
		return $adsUse;
	}
	else
	{
		$message = 'Use API method isn\'t properly formatted';
		add_settings_error($setting, 'use-error', $message, 'error');
		return false;
	}
}

function LA_includeT()
{
	include_once 'template.php';
}

?>
