import '@babel/polyfill';
import React from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';
import {TextField, withStyles} from "@material-ui/core";
import {dispatchField, dispatchFieldCurry} from "../util/Dispatch";
import * as PropTypes from "prop-types";
import Select from "@material-ui/core/Select";
import webservice, {ajaxStatus} from "../util/Webservice";
import MenuItem from "@material-ui/core/MenuItem";
import InputLabel from "@material-ui/core/InputLabel";
import FormControl from "@material-ui/core/FormControl";
import FormHelperText from "@material-ui/core/es/FormHelperText/FormHelperText";
import Button from "@material-ui/core/Button";
import CircularProgress from "@material-ui/core/CircularProgress";
import green from '@material-ui/core/colors/green';
import Slider from '@material-ui/lab/Slider';

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
	buttonProgress: {
		color: green[500],
		position: 'absolute',
		top: '50%',
		left: '50%',
		marginTop: -12,
		marginLeft: -12,
	},
	slider: {
		padding: '22px 0px',
	},
});

class CityGenForm extends React.Component {
	componentDidMount() {
		webservice.citygen.lists();
	}

	menuItemsFromList = list => {
		return [<MenuItem key="random" value="random">Random</MenuItem>]
			.concat((list || []).map(item => <MenuItem key={item.id} value={item.id}>{item.label}</MenuItem>));
	};

	generate = () => {
		console.log('generate');
	};

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
		const ajaxing = ajaxStatus.isAjaxing();

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
							disabled={ajaxing}
							inputProps={{ id: 'name', shrink: 'shrink' }}
							helperText={this.props.citygen.form.name === 'Custom' ? "Translated to the majority race language" : ''}
						/>
					</FormControl>

					{/* Population Type */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="populationType">Population Type</InputLabel>
						<Select
							value={this.props.citygen.form.population_type}
							onChange={dispatchFieldCurry('citygen.form.population_type')}
							inputProps={{ id: 'populationType' }}
							disabled={ajaxing}
						>
							{this.menuItemsFromList(this.props.citygen.lists.populationTypes)}
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
							disabled={ajaxing}
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
							disabled={ajaxing}
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
							disabled={ajaxing}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							<MenuItem key="yes" value="1">Yes</MenuItem>
							<MenuItem key="no" value="0">No</MenuItem>
						</Select>
					</FormControl>

					{/* # Gates */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="gates">Number of Gates</InputLabel>
						<Select
							value={this.props.citygen.form.gates}
							onChange={dispatchFieldCurry('citygen.form.gates')}
							inputProps={{ id: 'gates' }}
							disabled={ajaxing}
						>
							<MenuItem key="random" value="random">Random</MenuItem>
							{Array(11).fill(false).map((_, i) => <MenuItem key={i} value={i}>{i}</MenuItem>)}
						</Select>
						<FormHelperText>At least one gate means city has walls</FormHelperText>
					</FormControl>

					{/* # Professions */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="professions">Generate Professions</InputLabel>
						<Select
							value={this.props.citygen.form.professions}
							onChange={dispatchFieldCurry('citygen.form.professions')}
							inputProps={{ id: 'professions' }}
							disabled={ajaxing}
						>
							<MenuItem key="on" value="on">Yes</MenuItem>
							<MenuItem key="off" value="off">No</MenuItem>
						</Select>
					</FormControl>

					{/* # Buildings */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="buildings">Generate Buildings</InputLabel>
						<Select
							value={this.props.citygen.form.buildings}
							onChange={dispatchFieldCurry('citygen.form.buildings')}
							inputProps={{ id: 'buildings' }}
							disabled={ajaxing}
						>
							<MenuItem key="on" value="on">Yes</MenuItem>
							<MenuItem key="off" value="off">No</MenuItem>
						</Select>
					</FormControl>


					{/* Society Racial Type */}
					<FormControl className={classes.formControl}>
						<InputLabel shrink htmlFor="racial_mix">Society Type</InputLabel>
						<Select
							value={this.props.citygen.form.racial_mix}
							onChange={dispatchFieldCurry('citygen.form.racial_mix')}
							inputProps={{ id: 'racial_mix' }}
							disabled={ajaxing}
						>
							{this.menuItemsFromList(this.props.citygen.lists.integration)}
						</Select>
					</FormControl>
					{
						this.props.citygen.form.racial_mix === 'Custom' ? (
							/* Race ratio sliders */
							<FormControl className={classes.formControl}>
								<InputLabel shrink>Race Proportions</InputLabel>
								{
									this.props.citygen.lists.race.map(race =>
										<FormControl className={classes.formControl} key={race.id}>
											<InputLabel htmlFor={`race-slider-${race.id}`}>{race.label}</InputLabel>
											<Slider
												id={`race-slider-${race.id}`}
												classes={{ container: classes.slider }}
												value={this.props.citygen.form.raceRatios[race.id] === undefined ? 50 : this.props.citygen.form.raceRatios[race.id]}
												aria-labelledby="label"
												onChange={(control, value) => dispatchField(`citygen.form.raceRatios.${race.id}`, value)}
												disabled={ajaxing}
											/>
										</FormControl>
									)
								}
							</FormControl>
						) : (
							/* Major Race */
							<FormControl className={classes.formControl}>
								<InputLabel shrink htmlFor="race">Major Race</InputLabel>
								<Select
									value={this.props.citygen.form.race}
									onChange={dispatchFieldCurry('citygen.form.race')}
									inputProps={{id: 'race'}}
									disabled={ajaxing}
								>
									{this.menuItemsFromList(this.props.citygen.lists.race)}
								</Select>
							</FormControl>
						)
					}


					{/* Generate Button */}
					<FormControl className={classes.formControl}>
						<Button
							variant="contained"
							color="primary"
							onClick={this.generate}
							disabled={ajaxing}
						>
							Generate
						</Button>
						{ajaxing && <CircularProgress size={24} className={classes.buttonProgress} />}
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
\			</tbody>
		</table>
	</form>
</div>*/
	);
	}
}

CityGenForm.propTypes = propTypes;
CityGenForm.defaultProps = defaultProps;

export default withRouter(connect(mapStateToProps)(withStyles(styles)(CityGenForm)));
