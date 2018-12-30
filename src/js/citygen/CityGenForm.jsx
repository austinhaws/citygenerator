import '@babel/polyfill';
import React from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';
import {TextField, withStyles} from "@material-ui/core";
import {dispatchFieldCurry} from "../util/Dispatch";
import * as PropTypes from "prop-types";
import Select from "@material-ui/core/Select";
import webservice from "../util/Webservice";
import MenuItem from "@material-ui/core/MenuItem";
import InputLabel from "@material-ui/core/InputLabel";
import FormControl from "@material-ui/core/FormControl";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

const styles = theme => ({
	root: {
		display: 'flex',
		flexWrap: 'wrap',
		flexDirection: 'column',
		width: '250px',
		margin: '0 auto',
	},
	formControl: {
		margin: theme.spacing.unit,
		minWidth: 120,
	},
	selectEmpty: {
		marginTop: theme.spacing.unit * 2,
	},
});

class CityGenForm extends React.Component {
	componentDidMount() {
		webservice.citygen.lists();
	}

	/*
<script>

	var globals = {};

	globals.wards = <?=json_encode($table_buildings)?>;
	globals.wards_list = ['<?=kWard_Administration?>'
						, '<?=kWard_Craftsmen?>'
						, '<?=kWard_Gate?>'
						, '<?=kWard_Market?>'
						, '<?=kWard_Merchant?>'
						, '<?=kWard_Military?>'
						, '<?=kWard_Oderiforous?>'
						, '<?=kWard_Patriciate?>'
						, '<?=kWard_River?>'
						, '<?=kWard_Sea?>'
						, '<?=kWard_Shanty?>'
						, '<?=kWard_Slum?>'];
	globals.wards_mustache = [];
	globals.templates = new template_loader();

	$(function(){
		var select2s = $('.select2');
		select2s.filter('.hand-entered').select2({
			tags: true
			, maximumSelectionSize: 1
			//Allow manually entered text in drop down.
			, createSearchChoice: function (term, data) {
				if ($(data).filter(function () {
						return this.text.localeCompare(term) === 0;
					}).length === 0) {
					return {id: term, text: term};
				}
			}
			, data: [
				{id: '<?php echo kRandom; ?>', text:'Random'}
				, {id: '<?php echo kPopulationType_Thorp; ?>', text:'Thorp (20-80)'}
				, {id: '<?php echo kPopulationType_Hamlet; ?>', text:'Hamlet (81-400)'}
				, {id: '<?php echo kPopulationType_Village; ?>', text:'Village (401-900)'}
				, {id: '<?php echo kPopulationType_SmallTown; ?>', text:'Small Town (901-2000)'}
				, {id: '<?php echo kPopulationType_LargeTown; ?>', text:'Large Town (2001-5000)'}
				, {id: '<?php echo kPopulationType_SmallCity; ?>', text:'Small City (5001-12000)'}
				, {id: '<?php echo kPopulationType_LargeCity; ?>', text:'Large City (12001-32000)'}
				, {id: '<?php echo kPopulationType_Metropolis; ?>', text:'Metropolis (32001+)'}
			]
		});

		select2s.not('.hand-entered').select2({
			minimumResultsForSearch: -1
		});
	});

</script>

	 */
	render() {
		const { classes } = this.props;
		return (
			<React.Fragment>
				<div className={classes.root}>
					{/* Name */}
					<FormControl className={classes.formControl}>
						<TextField
							label="Name"
							autoFocus={true}
							onChange={dispatchFieldCurry('citygen.form.name')}
							placeholder="Random"
							value={this.props.citygen.form.name}
						/>
					</FormControl>

					{/* Population Type */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="populationType">Population Type</InputLabel>
						<Select
							value={this.props.citygen.form.population_type}
							onChange={dispatchFieldCurry('citygen.form.population_type')}
							inputProps={{ id: 'populationType' }}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							{(this.props.citygen.lists.populationTypes || []).map(populationType => <MenuItem key={populationType.id} value={populationType.id}>{populationType.label}</MenuItem>)}
							<MenuItem key="gi" value="45000">Gargantuan I (45,000)</MenuItem>
							<MenuItem key="gii" value="55000">Gargantuan II (55,000)</MenuItem>
							<MenuItem key="giii" value="65000">Gargantuan III (65,000)</MenuItem>
							<MenuItem key="giv" value="75000">Gargantuan IV (75,000)</MenuItem>
							<MenuItem key="gv" value="85000">Gargantuan V (85,000)</MenuItem>
						</Select>
					</FormControl>

					{/* By the Sea */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="byTheSea">By the Sea</InputLabel>
						<Select
							value={this.props.citygen.form.sea}
							onChange={dispatchFieldCurry('citygen.form.sea')}
							inputProps={{ id: 'byTheSea' }}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							<MenuItem key="yes" value="1">Yes</MenuItem>
							<MenuItem key="no" value="0">No</MenuItem>
						</Select>
					</FormControl>

					{/* By the River */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="byTheRiver">By the River</InputLabel>
						<Select
							value={this.props.citygen.form.river}
							onChange={dispatchFieldCurry('citygen.form.river')}
							inputProps={{ id: 'byTheRiver' }}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							<MenuItem key="yes" value="1">Yes</MenuItem>
							<MenuItem key="no" value="0">No</MenuItem>
						</Select>
					</FormControl>

					{/* Has Military */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="military">Has Military</InputLabel>
						<Select
							value={this.props.citygen.form.military}
							onChange={dispatchFieldCurry('citygen.form.military')}
							inputProps={{ id: 'military' }}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							<MenuItem key="yes" value="1">Yes</MenuItem>
							<MenuItem key="no" value="0">No</MenuItem>
						</Select>
					</FormControl>
				</div>
			</React.Fragment>
/*<div class="center">
	<br />
	<form method="POST" action="generate.php" id="generate-form">
		<input type="hidden" name="wards-added" />
		<table class="table_center" id="options-table">
			<thead />
			<tbody>
				<tr>
					<td class="field_title">Number of Gates</td>
					<td class="input" valign="top">
						<select name="gates" class="select2">
							<option value=<?php echo kRandom; ?> selected="selected">Random</option>
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
					<td></td>
					<td class="center italic">(At least one gate means city has walls)</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td
				</tr>
				<tr>
					<td class="field_title">Generate Buildings</td>
					<td class="input"><input type="checkbox" name="buildings" checked="checked" /></td>
				</tr>
				<tr class="wards-defining">
					<td class="field_title">Add Ward:</td>
					<td class="input">
						<select name="ward-list" class="select2">
							<option value=<?=kRandom?> selected="selected">Random</option>
							<option value="">--------------------</option>
							<option value="<?=kWard_Administration?>"><?=kWard_Administration?></option>
							<option value="<?=kWard_Craftsmen?>"><?=kWard_Craftsmen?></option>
							<option value="<?=kWard_Gate?>"><?=kWard_Gate?></option>
							<option value="<?=kWard_Market?>"><?=kWard_Market?></option>
							<option value="<?=kWard_Merchant?>"><?=kWard_Merchant?></option>
							<option value="<?=kWard_Military?>"><?=kWard_Military?></option>
							<option value="<?=kWard_Oderiforous?>"><?=kWard_Oderiforous?></option>
							<option value="<?=kWard_Patriciate?>"><?=kWard_Patriciate?></option>
							<option value="<?=kWard_River?>"><?=kWard_River?></option>
							<option value="<?=kWard_Sea?>"><?=kWard_Sea?></option>
							<option value="<?=kWard_Shanty?>"><?=kWard_Shanty?></option>
							<option value="<?=kWard_Slum?>"><?=kWard_Slum?></option>
						</select> <input type="button" value="Add Ward" class="sub-button" id="add-ward-button" />
					</td>
				</tr>
				<tr>
					<td class="field_title">Generate Professions</td>
					<td class="input"><input type="checkbox" name="professions" checked="checked" /></td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="field_title">Society Type</td>
					<td class="input">
						<select name="racial_mix" class="select2">
							<option value=<?php echo kRandom; ?> selected="selected">Random</option>
							<option>--------------------</option>
							<option value="<?php echo kIntegration_Isolated;?>"><?php echo kIntegration_Isolated;?></option>
							<option value="<?php echo kIntegration_Mixed;?>"><?php echo kIntegration_Mixed;?></option>
							<option value="<?php echo kIntegration_Integrated;?>"><?php echo kIntegration_Integrated;?></option>
							<option value="<?php echo kIntegration_Custom;?>"><?php echo kIntegration_Custom;?></option>
						</select>
					</td>
				</tr>
				<tr id="race-row">
					<td class="field_title">Major Race</td>
					<td class="input">
						<select name="race" class="select2">
							<option value=<?php echo kRandom; ?> selected="selected">Random</option>
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
				<tr id="race-ratio-row">
					<td class="field_title">Race Proportions</td>
					<td class="input">
						<ul>
							<li><?php echo kRace_Human?> <div class="<?php echo kRace_Human?> slider"></div></li>
							<li><?php echo kRace_Halfling?> <div class="<?php echo kRace_Halfling?> slider"></div></li>
							<li><?php echo kRace_Elf?> <div class="<?php echo kRace_Elf?> slider"></div></li>
							<li><?php echo kRace_Dwarf?> <div class="<?php echo kRace_Dwarf?> slider"></div></li>
							<li><?php echo kRace_Gnome?> <div class="<?php echo kRace_Gnome?> slider"></div></li>
							<li><?php echo kRace_HalfElf?> <div class="<?php echo kRace_HalfElf?> slider"></div></li>
							<li><?php echo kRace_HalfOrc?> <div class="<?php echo kRace_HalfOrc?> slider"></div></li>
							<li><?php echo kRace_Other?> <div class="<?php echo kRace_Other?> slider"></div></li>
						</ul>
						<input type="hidden" name="raceRatio" value=""/>
					</td>
				</tr>
				<tr><td>&nbsp;</td></tr>
				<tr>
					<td class="center" colspan="100"><input type="button" id="generate-button" value="Generate" /></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>*/
	);
	}
}

CityGenForm.propTypes = propTypes;
CityGenForm.defaultProps = defaultProps;

export default withRouter(connect(mapStateToProps)(withStyles(styles)(CityGenForm)));
