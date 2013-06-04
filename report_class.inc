<?php
class report_class {
	public function run($city) {
		$div_names = array();
		$output = '';

		// include the animatedcollapse stuff
		$output .= '
			<script src="js/jquery-1.9.1.min.js"></script>
			<script type="text/javascript" src="animatedcollapse.js">
				/***********************************************
				* Animated Collapsible DIV v2.4- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
				* This notice MUST stay intact for legal use
				* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
				***********************************************/
			</script>';

		$output .= '<form id="form_regenerate" action="generate.php" method="post">';
		foreach ($_POST as $key => $value) {
			if ($key == 'wards-added') {
				// wow, this is a hack!
				$output .= '<script>
					var globals = {};
					$(function() {
						$(\'[name="wards-added"]\').val(JSON.stringify(' . json_encode($value) . '));
						globals.layout = ' . json_encode($city->layout) . ';
					});
				</script>
				<input type="hidden" name="' . $key . '" value="" />
				';
			} else {
				$output .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
			}
		}
		$output .= '</form>';

		$output .= '<br />';
		$output .= '<div class="center italic"><a href="#" onclick="javascript:show_all()">Show All</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:hide_all()">Hide All</a></div>';
		$output .= '<br />';
		$output .= '<div class="center italic"><a href="#" onclick="javascript:regenerate()">Regenerate</a>&nbsp;&nbsp;&nbsp<a href="printable.php" target="_blank">Printable</a></div>';

		// city info
		$output .= '<br /><hr />';
		$output .= '<div class="center"><h1><a href="#" rel="toggle[city_stats]">' . $city->name . '</a></h1></div>';
		$output .= '<hr /><br />';

		$div_names[] = 'city_stats';
		$output .= table_center_begin();
		$output .= '<div id="city_stats"><span class="field_title">Community Size:</span>' . $city->population_type . '<br />';
		$output .= '<span class="field_title">Population:</span>' . output_integer($city->population_size) . ' Adults<br />';
		$output .= '<span class="field_title">Size:</span>' . output_double($city->acres) . ' Acres<br />';
		$output .= '<span class="field_title">Population Density (Adults/Acre):</span>' . output_double($city->population_size / $city->acres) . ' Adults/Acre<br />';
		$output .= '<span class="field_title">Races:</span>' . $city->output_races() . '<br />';
		$output .= '<br />';

		$output .= '<span class="field_title">Gold Piece Limit:</span>' . output_double($city->gold_piece_limit()) . '<br />';
		$output .= '<span class="field_title">Wealth:</span>' . output_double($city->wealth()) . '<br />';
		$output .= '<span class="field_title">Income for Lord(s)/King(s):</span>' . output_double($city->king_income()) . '<br />';
		$output .= '<span class="field_title">Magic Resources:</span>' . output_double($city->magic_resources()) . '<br />';
                $output .= '<br />';

		$output .= '<span class="field_title">Imports:</span>' . implode_and($city->commodities['import'], 'None') . '<br />';
		$output .= '<span class="field_title">Exports:</span>' . implode_and($city->commodities['export'], 'None') . '<br />';
                $output .= '<span class="field_title">Famous:</span>' . implode_and($city->famous['famous'], 'None') . '<br />';
                $output .= '<span class="field_title">Infamous:</span>' . implode_and($city->famous['infamous'], 'None') . '<br />';
		$output .= '<br />';

		$output .= '<span class="field_title"># of Wards:</span>' . output_integer(count($city->wards)) . '<br />';

		$total = 0;
		foreach ($city->wards as $ward) {
			$total += $ward->get_building_total();
		}
		$output .= '<span class="field_title"># of Buildings:</span>' . output_integer($total) . '<br />';
		$output .= '<span class="field_title"># of Power Centers:</span>' . output_integer(count($city->power_centers)) . '<br />';
		$output .= '<span class="field_title"># of Guilds:</span>' . output_integer($city->guilds_count()) . '<br />';

		if ($city->gates) {
			$output .= '<br /><span class="field_title">Has Walls</span><br />';
			$output .= '<span class="field_title"># of Gates:</span>' . $city->gates . '<br />';
		} else {
			$output .= '<br /><span class="field_title">No Walls</span><br />';
		}
		$output .= '</div>';
		$output .= table_center_end();

		// wards
		$output .= '<br /><hr />';
		$output .= '<div class="center"><h1><a href="#" rel="toggle[wards]");">Wards</a></h1></div>';
		$output .= '<hr /><br />';

		$div_names[] = 'wards';
		$output .= table_center_begin();
		$output .= '<div id="wards">';
		for ($i = 0, $count = count($city->wards); $i < $count; ++$i) {
			$ward = $city->wards[$i];
			$div_names[] = 'ward_detail_' . $i;
			$output .= '<div class="ward_type"><a href="#" rel="toggle[ward_detail_' . $i . ']">' . $ward->type . '</a></div>';
			$output .= '<div id="ward_detail_' . $i . '">';
			$output .= '<div class="ward_info">' . output_double($ward->acres) . ' Acres; ' . output_integer($ward->get_building_total()) . ' Structures; ';
			if ($ward->inside_walls) {
				$output .= 'Inside Walls';
			} else {
				$output .= 'Outside Walls';
			}
			$output .= '</div>';

			$output .= $ward->show_building_table();
			$output .= '<br /></div>';
		}
		$output .= '<br />';
		$output .= '<table class="table_center"><thead /><tbody><tr><td><span class="italic">Number in parenthesis after building type is the building\'s quality:';
		$output .= '<ul>';
		$output .= '<li>A is luxurious, royal, or imperial</li>';
		$output .= '<li>B is tasteful, ornate, or artistic</li>';
		$output .= '<li>C is utilitarian, basic, or normal</li>';
		$output .= '<li>D is derelict, condemened, rough, or functional</li>';
		$output .= '</ul></span></td></tr></tbody></table>';
		$output .= '<br /><br /></div>';
		$output .= table_center_end();

		// power centers
		$output .= '<br /><hr />';
		$output .= '<div class="center"><h1><a href="#" rel="toggle[professions]">Professions</a></h1></div>';
		$output .= '<hr /><br />';

		$div_names[] = 'professions';
		$output .= '<div id="professions">';
		$output .= $city->show_profession_counts();
		$output .= '</div>';

		if (count($city->power_centers)) {
			$output .= '<br /><hr />';
			$output .= '<div class="center"><h1><a href="#" rel="toggle[power_centers]">Power Centers</a></h1></div>';
			$output .= '<hr /><br />';

			$div_names[] = 'power_centers';
			$output .= '<div id="power_centers">';
			$output .= $city->show_power_centers($div_names);
			$output .= '</div>';
		}

		// guilds
		if ($city->guilds_count()) {
			$output .= '<br /><hr />';
			$div_names[] = 'guilds';
			$output .= '<div class="center"><h1><a href="#" rel="toggle[guilds]">Guilds</a></h1></div>';
			$output .= '<hr /><br />';

			$output .= '<div id="guilds">';
			$output .= $city->show_guilds_table();
			$output .= '</div>';
		}

		$output .= "<br /><br /><br />";


		$output .= '<script type="text/javascript">';

		foreach ($div_names as $name) {
			$output .= 'animatedcollapse.addDiv("' . $name . '", "fade=1' . ($name == 'city_stats' ? '' : ',hide=1') . '");';
		}

		$output .= 'animatedcollapse.init()';

		$output .= '
			function show_all() {';
		foreach ($div_names as $name) {
			$output .= 'animatedcollapse.show("' . $name . '", "fade=1");';
		}
		$output .= '
			}
			function hide_all() {';
		foreach ($div_names as $name) {
			$output .= 'animatedcollapse.hide("' . $name . '", "fade=1");';
		}
		$output .= '}';

                $output .= 'function regenerate() { document.getElementById("form_regenerate").submit(); }';
                $output .= '</script>';

		return $output;
	}
}
