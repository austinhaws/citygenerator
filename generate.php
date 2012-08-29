<?php
    session_start();
	require_once('global.inc');
	require_once('report_class.inc');
	
	include('template_top.inc');
	
	$city = new city_class();

if (!$_POST) {
	$_POST = array(
		'name' => ''
		, 'population_type' => 'random'
		, 'sea' => 'random'
		, 'river' => 'random'
		, 'military' => 'random'
		, 'gates' => 'random'
		, 'buildings' => 'on'
		, 'professions' => 'on'
		, 'race' => 'random'
		, 'racial_mix' => 'random'
	);
}	
	$city->random($_POST);
	
//	pprint_r($_POST, 'post', true);
//	pprint_r($city, 'city');
	
	echo '<link rel="stylesheet" type="text/css" href="city_generator.css" />';

	$report = new report_class();

	echo $report->run($city);
        $_SESSION['CITYGENERATOR'] = array('CITY' => serialize($city));


	function show_report_description() {
		global $use_statement;
		return '
<div id="content">
<div id="recent-posts">
	<h2>Your city has generated!</h2>
	<p>Click each section title to see its contents. Click the <a href="index.php">Homepage</a> button to generate a new city.</p>
	<div style="clear: both; height: 40px;">&nbsp;</div>' . $use_statement . '
</div>
		';
	}
	$bottom_data = 'show_report_description';
	include('template_bottom.inc');
?>
