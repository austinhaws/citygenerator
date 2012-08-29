<?php
    session_start();
    require_once('global.inc');
    $city = unserialize($_SESSION['CITYGENERATOR']['CITY']);
    if (!$city) {
    	exit("Session reset. Please regenerate.");
    }
    //pprint_r($city, 'city', true);
?>
Name: <?php echo $city->name;?>
<br /><br />
<div id="city_stats">
	<span class="field_title">Community Size: </span><?php echo $city->population_type;?><br />
	<span class="field_title">Population: </span><?php echo output_integer($city->population_size);?> Adults<br />
	<span class="field_title">Size: </span><?php echo output_double($city->acres);?> Acres<br />
	<span class="field_title">Population Density (Adults/Acre): </span><?php echo output_double($city->population_size / $city->acres);?> Adults/Acre<br />
	<span class="field_title">Races: </span><?php echo $city->output_races();?><br />
	<br />
			
	<span class="field_title">Gold Piece Limit: </span><?php echo output_double($city->gold_piece_limit());?><br />
	<span class="field_title">Wealth: </span><?php echo output_double($city->wealth());?><br />
	<span class="field_title">Income for Lord(s)/King(s): </span><?php echo output_double($city->king_income());?><br />
	<span class="field_title">Magic Resources: </span><?php echo output_double($city->magic_resources());?><br />
	<br />

	<span class="field_title">Imports: </span><?php echo implode_and($city->commodities['import'], 'None');?><br />
	<span class="field_title">Exports: </span><?php echo implode_and($city->commodities['export'], 'None');?><br />
	<span class="field_title">Famous: </span><?php echo implode_and($city->famous['famous'], 'None');?><br />
	<span class="field_title">Infamous: </span><?php echo implode_and($city->famous['infamous'], 'None');?><br />
	<br />
			
	<span class="field_title"># of Wards: </span><?php echo output_integer(count($city->wards));?><br />
			
	<?php
			$total = 0;
			foreach ($city->wards as $ward) {
				$total += $ward->get_building_total();
			}
	?>
	<span class="field_title"># of Buildings: </span><?php echo output_integer($total);?><br />
	<span class="field_title"># of Power Centers: </span><?php echo output_integer(count($city->power_centers));?><br />
	<span class="field_title"># of Guilds: </span><?php echo output_integer($city->guilds_count());?><br />
<?php if ($city->gates) { ?>
		<br /><span class="field_title">Has Walls</span><br />
		<span class="field_title"># of Gates: </span><?php echo $city->gates;?><br />
<?php } else {?>
		<br /><span class="field_title">No Walls</span><br />
<?php } ?>
</div>
		
<!-- wards -->
<br /><br />
<div id="wards">
<?php
		for ($i = 0, $count = count($city->wards); $i < $count; ++$i) {
			$ward = $city->wards[$i];
?>
	<div class="ward_type">Ward - <?php echo $ward->type;?></div>
	<div id="ward_detail_<?php echo $i;?>">
	<div class="ward_info"><?php echo output_double($ward->acres);?> Acres; <?php echo output_integer($ward->get_building_total());?> Structures; 
<?php if ($ward->inside_walls) { ?>
		Inside Walls
<?php } else { ?>
		Outside Walls
<?php } ?>
	</div>
<?php
		ksort($ward->buildings);
		$total = count($ward->buildings);
		$j = 0;
		foreach ($ward->buildings as $name => $num) {
			if ($j) {
				echo ', ';
			}
			echo '<span class="building_name">' . $name . '</span> : <span class="building_num">' . $num . '</span>';
			++$j;
		}
		if ($i < count($city->wards) - 1) {
			echo '<br /><br />';
		}
	} 
?>
<br /><br />
Number in parenthesis after building type is the building quality:
<ul>
<li>A is luxurious, royal, or imperial</li>
<li>B is tasteful, ornate, or artistic</li>
<li>C is utilitarian, basic, or normal</li>
<li>D is derelict, condemened, rough, or functional</li>
</ul>
</div>
<br />			
<div id="professions">
Professions<br />
<?php
		$count = 0;
		foreach ($city->professions as $key => $value) {
			if ($count++) {
				echo ', ';
			}
			
			echo $key . ' : ' . $value;
		}
?>
</div>

<?php		if (count($city->power_centers)) {	 ?>
	<br /><br />
	<div id="power_centers">
<?php	foreach ($city->power_centers as $power_center) { ?>
Power Center - <?php echo $power_center->type;?><br />
Alignment: <?php echo $power_center->alignment;?><br />
Wealth: <?php echo output_double($power_center->wealth);?><br />
Influence Points: <?php echo output_integer($power_center->influence_points);?><br />
Total NPCs (Class Level - Count): <?php echo output_integer($power_center->number_npcs());?><br />
<?php
		foreach ($power_center->npcs as $class => $data) {
			echo $class . ' ';
			$count = 0;
			foreach ($data as $level => $amount) {
				if ($count++) {
					echo ', ';
				}
				echo $level . '-' . $amount;
			}
			echo '<br />';
		}
			echo '<br />';
	}?>
	</div>
<?php } ?>

<?php if ($city->guilds_count()) { ?>
	<div id="guilds">Guild<?php echo $city->guilds_count() > 1 ? 's' : '';?> - 
<?php		$count = 0;
		foreach ($city->guilds as $name => $num) {
			if ($num) {
				if ($count++) {
					echo ', ';
				}
				
				echo $name . ' : ' . $num;
			}
		}
?>
	</div>
<?php } ?>
