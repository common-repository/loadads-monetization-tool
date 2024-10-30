<?php

loadads_xOK();



$urlName = 'LoadAds';
$baseUrl = '//loadads.com/pub/';
$newUUrl = $baseUrl.'new_user.php';



$LA_ads_Pub = get_option('LA_ads_Pub');
$LA_ads_Api = get_option('LA_ads_Api');
$LA_ads_How = get_option('LA_ads_How');
$LA_ads_Use = get_option('LA_ads_Use');
$LA_arr_How = get_option('LA_arr_How');
$LA_arr_Use = get_option('LA_arr_Use');
$LA_ads_Off = get_option('LA_ads_Off');



if(!isset($LA_ads_How) || empty($LA_ads_How))
$LA_ads_How = 0;



if( isset($LA_ads_Pub) && !empty($LA_ads_Pub) )
{
	$lnk_pan = '<a href="'.$baseUrl.$LA_ads_Pub.'/logs.php" target="_blank" class="" style="float:right">check</a>';
}
if( isset($LA_ads_Api) && !empty($LA_ads_Api) )
{
	$lnk_api = '<a href="'.$baseUrl.$LA_ads_Pub.'/logs.php#modApi" target="_blank" class="" style="float:right">check</a>';
}

?>

<div class="wrap">
	<h2>
		<?php echo LA_put_logo(); ?>
		Publisher Code Integration
		<span style="float:right;">
			<?php
			if(!isset($LA_ads_Pub) || empty($LA_ads_Pub))
			{
				echo '
					<a
						style="vertical-align:middle"
						href="'.$newUUrl.'"
						target="_blank"
						class="button-primary"
					>
						SignUp at '.$urlName.'
					</a>
				';
			}
			?>

			<input
				style="vertical-align:middle"
				type="button"
				onclick="location.href='admin.php?page=loadads-com&loadads_switch=switch';"
				value="<?php echo (get_option('LA_ads_Off') == 1 ? 'Enable All '.$urlName.' Codes' : 'Disable All '.$urlName.' Codes'); ?>"
				class="button-secondary"
			/>
		</span>
	</h2>

	<?php
	if(!isset($LA_ads_Pub) || empty($LA_ads_Pub))
	echo '
	<var>
		Not yet a registered '.$urlName.' Publisher? Do <a href="'.$newUUrl.'" target="_blank"><strong>sign-up here</strong></a>
	</var>
	';
	?>

	<?php settings_errors(); ?>

	<div class="notice" style="min-height:370px;">

	<?php echo loadads_xKO(); ?>

<?php
if ((bool)get_option('LA_ads_Off') === false)
{
?>



<form method="post" action="options.php">
<?php
	echo '
			<h3>
				'.$urlName.' <span style="color:#FF7700;">'.$LA_arr_How[$LA_ads_How].'</span> Setup
			</h3>
	';

	if(!isset($LA_ads_Pub) || empty($LA_ads_Pub))
	echo '
			<span style="border-top:1px solid #EEE;">Note : Please insert the Panel URL or Panel ID into the field below to use <b>'.$urlName.' Monetization</b>.</span>
	';
	else
	if($LA_ads_Pub != get_option('LA_ads_Pub'))
	echo '
			<span style="border-top:1px solid #EEE;">Note : Simply click Save Changes to use '.$urlName.' Monetization.</span>
	';
	else
	echo '
			<span style="border-top:1px solid #EEE;">Note : This Monetization is ready to be used.</span>
	';

	echo '<div class="ads_Xsetting" style="margin:25px 0 25px 0; padding:25px 25px 0 25px; border:1px dotted #AAA;">';

	echo '<div style="width:20%; float:left;">';
	echo '
			<div class="input-group" style="margin:0 0 25px 0; padding:0 0 15px 0; border-bottom:1px dashed #CCC;">
				<label for="LA_ads_How" style="display:block;">Use As</label>
				<select name="LA_ads_How" id="LA_ads_How" style="width:100%;">
					<option value="1" '.((get_option('LA_ads_How') == '1' )?'selected':'').'>'.$LA_arr_How[1].'</option>
					<option value="2" '.((get_option('LA_ads_How') == '2' )?'selected':'').'>'.$LA_arr_How[2].'</option>
					<option value="3" '.((get_option('LA_ads_How') == '3' )?'selected':'').'>'.$LA_arr_How[3].'</option>
				</select>
			</div>
	';
	echo '</div>';
	echo '<div style="width:75%; float:right;">';
	echo '
			<div class="input-group" style="margin:0 0 25px 0; padding:0 0 15px 0; border-bottom:1px dashed #CCC;">
				'.(isset($lnk_pan)?$lnk_pan:'').'
				<label for="LA_ads_Pub">Panel ID</label>
				<input
					style="width:100%;" name="LA_ads_Pub" type="text" id="LA_ads_Pub"
					value="' . (isset($LA_ads_Pub)?$LA_ads_Pub:'') .'"
					placeholder="[required] eg : e29f7f586d772a028bc80a5898e06fa4"
				/>
			</div>
	';
	echo '</div>';

	echo '<div style="clear:both;"></div>';

	echo '<div style="width:20%; float:left;">';
	echo '
			<div class="input-group" style="margin:0 0 25px 0; padding:0 0 15px 0; border-bottom:1px dashed #CCC;">
				<label for="LA_ads_Use" style="display:block;">Use API</label>
				<select name="LA_ads_Use" id="LA_ads_Use" style="width:100%;">
					<option value="1" '.((get_option('LA_ads_Use') == '1' )?'selected':'').'>Yes</option>
					<option value="2" '.((get_option('LA_ads_Use') == '2' )?'selected':'').'>No</option>
				</select>
			</div>
	';
	echo '</div>';
	echo '<div style="width:75%; float:right;">';
	echo '
			<div class="input-group" style="margin:0 0 25px 0; padding:0 0 15px 0; border-bottom:1px dashed #CCC;">
				'.(isset($lnk_api)?$lnk_api:'').'
				<label for="LA_ads_Api">API Key</label>
				<input
					style="width:100%;" name="LA_ads_Api" type="text" id="LA_ads_Api"
					value="' . (isset($LA_ads_Api)?$LA_ads_Api:'') .'"
					placeholder="[optional] eg : Um43dW1yaGtDQTJ2RHRuMGJIQzhkQjMxZkczM1lvSU9Dd3M4MkkxT1hIWWRXYm1OWTdQS0VUdDV3TGNhOWxZcHkrcDFZbndzRndKczlWd3oxM21ta2ZsamdaZDMrUGtUeXE1a2ZMSmdVelpwK3VWZ0d2T1MycXFoYUIyZzVNSnQ="
				/>
			</div>
	';
	echo '</div>';

	echo '<div style="clear:both;"></div>';

	echo '</div>';

	settings_fields( 'ads_opt_grp' );
	do_settings_fields( 'loadads-com', 'ads_opt_grp' );

	echo '
				<input type="hidden" name="action" value="update" />
	';
?>
	<p>
		<input type="submit" name="submit" value="<?php _e('Save Changes & Use Current Monetization') ?>" class="button-primary" />
	</p>
</form>

<?php
}
?>

	</div>
</div>



<?php
if ((bool)get_option('LA_ads_Off') === false)
if(
	isset($LA_ads_Pub) && !empty($LA_ads_Pub) &&
	isset($LA_ads_Api) && !empty($LA_ads_Api) &&
	isset($LA_ads_How) && !empty($LA_ads_How) &&
	isset($LA_ads_Use) && $LA_ads_Use == '1'
	)
{
	$theDate = date('Y-m-d');
	$api_url = 'http:'.$baseUrl.$LA_ads_Pub.'/logs.php?api=true&date='.$theDate.'&key='.$LA_ads_Api;
	$apiJson = @file_get_contents($api_url, false);
	if(isset($apiJson) && !empty($apiJson))
	{
		$api_Arr = json_decode($apiJson, true);
		//echo '<pre>'; print_r($api_Arr); echo '</pre>';

		$api_Err = '';
		if(isset($api_Arr['error']))
		{
			$pub_lnk = $baseUrl.$LA_ads_Pub.'/logs.php#modApi';
			$api_Err = '<a href="'.$pub_lnk.'" class="button-secondary" target="_blank">'.ucfirst($api_Arr['error']).'</a>';
		}

		$hits_ok = (isset($api_Arr['accepted']['oneVolume'])?(int)$api_Arr['accepted']['oneVolume']:0);
		//echo '$hits_ok: '.$hits_ok."\n<br />\n";

		$hits_kk = 0 +
							(isset($api_Arr['unneeded']['asnVolume'])?(int)$api_Arr['unneeded']['asnVolume']:0) +
							(isset($api_Arr['unneeded']['torVolume'])?(int)$api_Arr['unneeded']['torVolume']:0)
							;
		//echo '$hits_kk: '.$hits_kk."\n<br />\n";

		$hits_ko = 0 +
							(isset($api_Arr['rejected']['botVolume'])?(int)$api_Arr['rejected']['botVolume']:0) +
							(isset($api_Arr['rejected']['wvwVolume'])?(int)$api_Arr['rejected']['wvwVolume']:0) +
							(isset($api_Arr['rejected']['wvwDouble'])?(int)$api_Arr['rejected']['wvwDouble']:0) +
							(isset($api_Arr['rejected']['oxyVolume'])?(int)$api_Arr['rejected']['oxyVolume']:0) +
							(isset($api_Arr['rejected']['ckyVolume'])?(int)$api_Arr['rejected']['ckyVolume']:0) +
							(isset($api_Arr['rejected']['boxVolume'])?(int)$api_Arr['rejected']['boxVolume']:0) +
							(isset($api_Arr['rejected']['relVolume'])?(int)$api_Arr['rejected']['relVolume']:0) +
							(isset($api_Arr['rejected']['frdVolume'])?(int)$api_Arr['rejected']['frdVolume']:0) +
							(isset($api_Arr['rejected']['smlVolume'])?(int)$api_Arr['rejected']['smlVolume']:0) +
							(isset($api_Arr['rejected']['refVolume'])?(int)$api_Arr['rejected']['refVolume']:0) +
							(isset($api_Arr['rejected']['nipVolume'])?(int)$api_Arr['rejected']['nipVolume']:0) +
							(isset($api_Arr['rejected']['urlVolume'])?(int)$api_Arr['rejected']['urlVolume']:0)
							;
		//echo '$hits_ko: '.$hits_ko."\n<br />\n";

		echo '
			<div class="notice">
				<h3>
					API Response <span style="color:#FF7700;">Traffic Stats</span>
					&nbsp;
					'.$api_Err.'
					<small style="float:right">'.$theDate.'</small>
				</h3>

				<div style="padding:0 0 25px 0;">
					<hr style="clear:both;" />
					<div class="threeCol" style="width:33%; float:left; margin:0; padding:0 0 25px 0;">
						<h5>Accepted Impressions</h5>
						<b>'.$hits_ok.'</b>
					</div>
					<div class="threeCol" style="width:33%; float:left; margin:0; padding:0 0 25px 0;">
						<h5>Unneeded Impressions</h5>
						<b>'.$hits_kk.'</b>
					</div>
					<div class="threeCol" style="width:33%; float:left; margin:0; padding:0 0 25px 0;">
						<h5>Rejected Impressions</h5>
						<b>'.$hits_ko.'</b>
					</div>
					<hr style="clear:both;" />
				</div>

			</div>
		';
	}
}
?>
