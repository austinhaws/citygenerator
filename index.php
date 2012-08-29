<?php
	require_once('global.inc');
	
	include 'template_top.inc';
?>
<link rel="stylesheet" type="text/css" href="city_generator.css" />
<div class="center">
	<br />
	<form method="POST" action="generate.php">
		<table class="table_center">
			<thead />
			<tbody>
				<tr>
					<td class="field_title">Name:</td>
					<td class="input"><input type="input" name="name" value="" /></td>
				</tr>
				<tr>
					<td class="field_title">Population:</td>
					<td class="input">
						<select name="population_type">
							<option value=<?php echo kRandom; ?>>Random</option>
							<option>--------------------</option>
							<option value="<?php echo kPopulationType_Thorp;?>" CHECKED>Thorp (20-80)</option>
							<option value="<?php echo kPopulationType_Hamlet;?>">Hamlet (20-80)</option>
							<option value="<?php echo kPopulationType_Village;?>">Village (401-900)</option>
							<option value="<?php echo kPopulationType_SmallTown;?>">Small Town (901-2000)</option>
							<option value="<?php echo kPopulationType_LargeTown;?>">Large Town (2001-5000)</option>
							<option value="<?php echo kPopulationType_SmallCity;?>">Small City (5001-12000)</option>
							<option value="<?php echo kPopulationType_LargeCity;?>">Large City (12001-25000)</option>
							<option value="<?php echo kPopulationType_Metropolis;?>">Metropolis (25001+)</option>
						</select>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="field_title">By the Sea:</td>
					<td class="input">
						<input type="Radio" name="sea" value="1">Yes</input>
						<input type="Radio" name="sea" value="0">No</input>
						<input type="Radio" name="sea" value=<?php echo kRandom; ?> CHECKED>Random</input>
					</td>
				</tr>
				<tr>
					<td class="field_title">By a River:</td>
					<td class="input">
						<input type="Radio" name="river" value="1">Yes</input>
						<input type="Radio" name="river" value="0">No</input>
						<input type="Radio" name="river" value=<?php echo kRandom; ?> CHECKED>Random</input>
					</td>
				</tr>
				<tr>
					<td class="field_title">Has Military:</td>
					<td class="input">
						<input type="Radio" name="military" value="1">Yes</input>
						<input type="Radio" name="military" value="0">No</input>
						<input type="Radio" name="military" value=<?php echo kRandom; ?> CHECKED>Random</input>
					</td>
				</tr>
				<tr>
					<td class="field_title">Number of Gates</td>
					<td class="input" valign="top">
						<select name="gates">
							<option value=<?php echo kRandom; ?> CHECKED>Random</option>
							<option>--------------------</option>
							<option value="0">0</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="100" class="center italic">(At least one gate means city has walls)</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td
				</tr>
				<tr>
					<td class="field_title">Generate Buildings</td>
					<td class="input"><input type="checkbox" name="buildings" CHECKED /></td>
				</tr>
				<tr>
					<td class="field_title">Generate Professions</td>
					<td class="input"><input type="checkbox" name="professions" CHECKED /></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="field_title">Major Race</td>
					<td class="input">
						<select name="race">
							<option value=<?php echo kRandom; ?> CHECKED>Random</option>
							<option>--------------------</option>
							<option value="<?php echo kRace_Human;?>"><?php echo kRace_Human;?></option>
							<option value="<?php echo kRace_Halfling;?>"><?php echo kRace_Halfling;?></option>
							<option value="<?php echo kRace_Elf;?>"><?php echo kRace_Elf;?></option>
							<option value="<?php echo kRace_Dwarf;?>"><?php echo kRace_Dwarf;?></option>
							<option value="<?php echo kRace_Gnome;?>"><?php echo kRace_Gnome;?></option>
							<option value="<?php echo kRace_HalfElf;?>"><?php echo kRace_HalfElf;?></option>
							<option value="<?php echo kRace_HalfOrc;?>"><?php echo kRace_HalfOrc;?></option>
							<option value="<?php echo kRace_Other;?>"><?php echo kRace_Other;?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="field_title">Society Type</td>
					<td class="input">
						<select name="racial_mix">
							<option value=<?php echo kRandom; ?> CHECKED>Random</option>
							<option>--------------------</option>
							<option value="<?php echo kIntegration_Isolated;?>"><?php echo kIntegration_Isolated;?></option>
							<option value="<?php echo kIntegration_Mixed;?>"><?php echo kIntegration_Mixed;?></option>
							<option value="<?php echo kIntegration_Integrated;?>"><?php echo kIntegration_Integrated;?></option>
						</select>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="center" colspan="100"><input type="submit" value="Generate" /></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<?php
	function show_index_description() {
		global $use_statement;
		return '
<div id="content">
<div id="recent-posts">
	<h2>Explanation</h2><br />
			<h3>The RPG City Generator takes a number of inputs and returns detailed, randomly generated, information about a city. It includes  professions, medieval buildings, guilds, local hero classes and levels, and many other role playing tools to make your campaign worlds more believable. Your fantasy adventures just got more detailed and exciting for your players with information about each city\'s wards, establishments, imports and exports, income, and lots more to make your role playing game full of rich detail for your players to enjoy. Here is a description of the settings involved.</h3>
			<p class="byline">	</p>
			<table class="table_center">
				<thead />
				<tbody>
					<tr>
						<td class="right field_title2">Name:</td>
						<td class="explanation">The city\'s name. If this field is blank, then a name will be randomly generated for the city. The generated name will be translated to the majority race language.</td>
					</tr>
					<tr>
						<td class="right field_title2">Population:</td>
						<td class="explanation">The number of people in the city. This is the base determiner for most all the stats, so choose wisely. Right now it is randomly chosen from a given range, but if requested, this can be changed to allow an entered value.</td>
					</tr>
					<tr>
						<td class="right field_title2">By the Sea:</td>
						<td class="explanation">Does this city exist by the sea or ocean? If so, then one or more "Sea" ward(s) will be added to the city.</td>
					</tr>
					<tr>
						<td class="right field_title2">By a River:</td>
						<td class="explanation">Does this city exist by a river? Or maybe one or more rivers flow through the city?</td>
					</tr>
					<tr>
						<td class="right field_title2">Has Military:</td>
						<td class="explanation">Does this city have a military stationed in it? Not even the biggest cities always have an army. This is not the local constabulary, but a full blown army.</td>
					</tr>
					<tr>
						<td class="right field_title2">Number of Gates:</td>
						<td class="explanation">How many gates does the city have in its walls? If the city has no walls, then the number of gates is 0 and vice versa.</td>
					</tr>
					<tr>
						<td class="right field_title2">Generate Buildings:</td>
						<td class="explanation">If you don\'t want to know all the buildings in a ward and you find it extremely annoying, you can have them turned off.</td>
					</tr>
					<tr>
						<td class="right field_title2">Generate Professions:</td>
						<td class="explanation">If you don\'t want to know all the professions of each and everyone member of the city and you find it extremely annoying, you can have them turned off. If generate professions is turned off, guilds will also not generate.</td>
					</tr>
					<tr>
						<td class="right field_title2">Major Race:</td>
						<td class="explanation">This allows selecting the predominant race of the city. Depending on the Society Type, other races have a percentage of minority for the city. The race also determines the type of name that will be randomly generated for a city (if the name isn\'t specifically given).</td>
					</tr>
					<tr>
						<td class="right field_title2">Society Type:</td>
						<td class="explanation">Depending on how remote or popular a city is, effects the types of inhabitants found in it.</td>
					</tr>
				</tbody>
			</table>
        <br /><br />
        <div id="latest-post" class="post" >
        <br />
	<div style="clear: both; height: 40px;">&nbsp;</div>' . $use_statement . '
</div>
</div>
		';
	}

	$bottom_data = 'show_index_description';
	include 'template_bottom.inc';
?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34431316-1']);
  _gaq.push(['_setDomainName', 'crystalballsoft.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>