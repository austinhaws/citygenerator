import '@babel/polyfill';
import React from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';
import * as PropTypes from "prop-types";
import withRoot from "../../app/WithRoot";
import Pages from "../../app/Pages";
import GeneratedTopButtons from "./GeneratedTopButtons";
import ListSubheader from "@material-ui/core/ListSubheader";
import List from "@material-ui/core/List";
import webservice from "../../util/Webservice";
import ListItemDetail from "./ListItemDetail";
import LabelValue from "./LabelValue";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

const SECTIONS = {
	cityDetail: 'cityDetail',
};

class CityGenGenerated extends React.Component {

	constructor(props) {
		super(props);

		this.state = {
			openSections: {
				[SECTIONS.cityDetail]: true,
			},
		};

		if (!this.props.citygen.generatedCity) {
			this.generate();
		}
	}

	toggleSection = sectionName => this.setState({openSections: Object.assign({}, this.state.openSections, {[sectionName]: !this.state.openSections[sectionName]})});

	generate = () => webservice.citygen.generate();

	closeSections = () => this.setState({openSections: _.mapValues(this.state.openSections, () => false)});
	openSections = () => this.setState({openSections: _.mapValues(this.state.openSections, () => true)});

	formatGP = amount => `${amount.toFixed(2)} gp`;
	formatList = list => (list && list.length) ? list.join(', ') : 'None';

	render() {
		const {classes} = this.props;
		const city = this.props.citygen.generatedCity;
		const br = 'br';

console.log('generated!', city);
		return city ? (
			<div>
				<GeneratedTopButtons
					onBackClick={() => Pages.cityGen.home.forward(this.props.history)}
					onHideAllClick={this.closeSections}
					onPrintClick={() => alert('Print...')}
					onRegenerateClick={this.generate}
					onShowAllClick={this.openSections}
				/>
				<hr/>
				<List
					component="nav"
					subheader={<ListSubheader component="div" className={classes.generated_list_title}>{city.name}</ListSubheader>}
					className={classes.generated_list}
				>
					<ListItemDetail
						title="City Detail"
						isExpanded={this.state.openSections[SECTIONS.cityDetail]}
						onToggleExpanded={() => this.toggleSection(SECTIONS.cityDetail)}
						classes={classes}
						detail={
							<React.Fragment>
								{
									[
										{label: 'Community Size', value: city.populationType},
										{label: 'Population', value: `${city.populationSize} Adults`},
										{label: 'Size', value: `${city.acres} Acres`},
										{label: 'Population Density (Adults/Acre)', value: `${city.populationDensity} Adults/Acre`},
										{label: 'Races', value: city.races
												.filter(race => race.total)
												.map(race => <span key={race.race}>{race.race} ({race.total})</span>)
												.reduce((prev, curr, i) => [prev, <br key={`br-${i}`}/>, curr])},
										br,

										{label: 'Gold Piece Limit', value: this.formatGP(city.goldPieceLimit)},
										{label: 'Wealth', value: this.formatGP(city.wealth)},
										{label: 'Income for Lord(s)/King(s)', value: this.formatGP(city.kingIncome)},
										{label: 'Magic Resources', value: this.formatGP(city.magicResources)},
										br,

										{label: 'Imports', value: this.formatList(city.commoditiesImport)},
										{label: 'Exports', value: this.formatList(city.commoditiesExport)},
										{label: 'Famous', value: this.formatList(city.famous)},
										{label: 'Infamous', value: this.formatList(city.infamous)},
										br,

										{label: '# of Wards', value: city.wards.length},
										{label: '# of Buildings', value: city.numberBuildings},
										{label: '# of Power Centers', value: city.powerCenters.length},
										{label: '# of Guilds', value: city.guilds.length},
										{label: 'Walls', value: city.numGates ? 'Has Walls' : 'No Walls'},
									].map((item, i) =>
										item === br ?
											<div key={i} className={classes.labelValue_container_br}/> :
											<LabelValue key={item.label} classes={classes} label={item.label} value={item.value}/>
									)
								}

								{city.numGates ? <LabelValue classes={classes} label="# of Gates" value={city.numGates}/> : undefined}
							</React.Fragment>
						}
					/>
				</List>
			</div>
		) : null;
	}
}
/*
<script id="options-ward-detail" type="text/html">
	<tr class="wards-defining">
		<td />
		<td>
			<table class="ward-added">
				<tr>
					<td colspan="100" class="ward-title" data-name="{{name}}">{{name}}:<input type="button" value="Remove" class="ward-remove-button" /></td>
				</tr>
				<tr>
					<td>
						<div class="options-ward-buildings">
							{{#buildings}}
								<div class="ward-building">
									<div class="ward-building-name" data-type="{{type}}">{{type}}:</div>
									<input class="ward-building-ratio" type="text" data-building="{{type}}" value="{{ratio}}" />
								</div>
							{{/buildings}}
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</script>

<script id="city-printable" type="text/html">
<div id="wards">
	{{#wards}}{{#show_ward_list}}
		<div class="ward_type">Ward - {{type_public}}</div>
		<div>
		<div class="ward_info">
			{{acres_output}} Acres; {{building_total_output}} Structures;
			{{#inside_walls}}
				Inside Walls
			{{/inside_walls}}
			{{^inside_walls}}
				Outside Walls
			{{/inside_walls}}
		</div>
		{{#buildings}}
			<span class="building_name">{{key}}</span> : <span class="building_num">{{total}}; </span>
		{{/buildings}}
		<br /><br />
	{{/show_ward_list}}{{/wards}}
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
{{#professions}}
	{{profession}} : {{total}};
{{/professions}}

{{! power centers}}
{{#power_centers_exists}}
	<br /><br />
	<div id="power_centers">
		{{#power_centers}}
			Power Center - {{type}}<br />
			Alignment: {{alignment}}<br />
			Wealth: {{wealth_output}}<br />
			Influence Points: {{influence_points_output}}<br />
			Total NPCs (Class Level - Count): {{npcs_total_output}}<br />
			{{#npcs}}
				{{class}}
				{{#levels}}
					{{level}}-{{count}},
				{{/levels}}
				<br />
			{{/npcs}}
		<br />
		{{/power_centers}}
	</div>
{{/power_centers_exists}}

{{#guilds_count}}
	<div id="guilds">Guilds -
		{{#guilds}}
			{{guild}} : {{total}};
		{{/guilds}}
	</div>
{{/guilds_count}}

<br />
<br />
<div>Layout</div>
	<div id="layout"></div>
</script>


<script id="city-ward-detail" type="text/html">
	<div class="ward">
		<div class="ward_type" data-ward-id="{{id}}" data-ward-type="{{letter}}"><span>{{type_public}}</span> <span>({{id_letter}})</span></div>
		<div class="ward_detail ward-id-{{id}}">
			<div class="ward_info">
				{{acres_output}} Acres; {{building_total_output}} Structures;
				{{#inside_walls}}
					Inside Walls
				{{/inside_walls}}
				{{^inside_walls}}
					Outside Walls
				{{/inside_walls}}
			</div>

			<div class="ward_buildings">
				{{#buildings}}
					<div class="building">{{key}}:{{total}}</div>
				{{/buildings}}
			</div>
		</div>
	</div>
</script>

<script id="city-detail" type="text/html">

	{{! city info }}
	<div class="center toggleable" data-toggle-target="#city_stats"><h1>{{name}}</h1></div>

	<div id="city_stats">
		<div class="line"><span class="field_title">Community Size:</span>{{population_type}}</div>
		<div class="line"><span class="field_title">Population:</span>{{population_size_formatted}} Adults</div>
		<div class="line"><span class="field_title">Size:</span>{{acres_formatted}} Acres</div>
		<div class="line"><span class="field_title">Population Density (Adults/Acre):</span>{{population_density}} Adults/Acre</div>
		<div class="line"><span class="field_title">Races:</span>{{races_output}}</div>

		<div class="line margin-top"><span class="field_title">Gold Piece Limit:</span>{{gold_piece_limit_output}}</div>
		<div class="line"><span class="field_title">Wealth:</span>{{wealth_output}}</div>
		<div class="line"><span class="field_title">Income for Lord(s)/King(s):</span>{{king_income_output}}</div>
		<div class="line"><span class="field_title">Magic Resources:</span>{{magic_resources_output}}</div>

		<div class="line margin-top"><span class="field_title">Imports:</span>{{commodities_import}}</div>
		<div class="line"><span class="field_title">Exports:</span>{{commodities_export}}</div>
		<div class="line"><span class="field_title">Famous:</span>{{famous_famous}}</div>
		<div class="line"><span class="field_title">Infamous:</span>{{famous_infamous}}</div>

		<div class="line margin-top"><span class="field_title"># of Wards:</span>{{wards_count}}</div>
		<div class="line"><span class="field_title"># of Buildings:</span>{{buildings_total_output}}</div>
		<div class="line"><span class="field_title"># of Power Centers:</span>{{power_centers_count}}</div>
		<div class="line"><span class="field_title"># of Guilds:</span>{{guilds_count}}</div>

		{{#gates}}
			<div class="line margin-top"><span class="field_title">Has Walls</span></div>
			<div class="line"><span class="field_title"># of Gates:</span>{{gates}}</div>
		{{/gates}}
		{{^gates}}
			<div class="line margin-top"><span class="field_title">No Walls</span></div>
		{{/gates}}
	</div>

	{{! wards }}
	<div class="center toggleable group-title" data-toggle-target=".wards-container"><h1>Wards</h1></div>
	<div class="content-container wards-container toggled-closed">
		<div id="wards">
			{{#wards}}
				{{#show_ward_list}}
				<div class="ward">
					<div class="ward_type" data-ward-id="{{id}}"><span class="toggleable" data-toggle-target=".ward-id-{{id}}">{{type_public}}</span> <span class="ward-layout-key">(city layout: {{id_letter}})</span></div>
					<div class="ward_detail ward-id-{{id}} toggled-closed">
						<div class="ward_info">
							{{acres_output}} Acres; {{building_total_output}} Structures;
							{{#inside_walls}}
								Inside Walls
							{{/inside_walls}}
							{{^inside_walls}}
								Outside Walls
							{{/inside_walls}}
						</div>

						<div class="ward_buildings">
							{{#buildings}}
								<div class="building">{{key}} : {{total}}</div>
							{{/buildings}}
						</div>
					</div>
				</div>
				{{/show_ward_list}}
			{{/wards}}
			<div class="building-types">
				<div class="building-types-centerer">
					<span class="italic">Number in parenthesis after building type is the building's quality:
					<ul>
					<li>A is luxurious, royal, or imperial</li>
					<li>B is tasteful, ornate, or artistic</li>
					<li>C is utilitarian, basic, or normal</li>
					<li>D is derelict, condemened, rough, or functional</li>
					</ul></span>
				</div>
			</div>
		</div>
	</div>


	{{! professions }}
	<div class="center toggleable group-title" data-toggle-target="#professions"><h1>Professions</h1></div>
	<div id="professions" class="toggled-closed">
		{{#professions}}
			<div class="profession">{{profession}} : {{total}}</div>
		{{/professions}}
	</div>

	{{! power centers }}
	{{#power_centers_exists}}
		<div class="center toggleable group-title" data-toggle-target="#power_centers"><h1>Power Centers</h1></div>

		<div id="power_centers" class="toggled-closed">
		{{#power_centers}}
			<div class="power-center">
				<div class="power-center-type toggleable" data-toggle-target=".power-center-id-{{id}}">{{type}}</div>
				<div class="power-center-detail power-center-id-{{id}} toggled-closed">
					<div class="line"><span class="field_title">Alignment:</span>{{alignment}}</div>
					<div class="line"><span class="field_title">Wealth:</span>{{wealth_output}}</div>
					<div class="line"><span class="field_title">Influence Points:</span>{{influence_points_output}}</div>
					<div class="line"><span class="field_title">Total NPCs:</span>{{npcs_total_output}}</div>

					<div class="power-centers">
						<div class="line">
							<div class="th npc-class">&darr; NPC : Level &rarr;</div>
							<div class="th npc-number">1</div>
							<div class="th npc-number">2</div>
							<div class="th npc-number">3</div>
							<div class="th npc-number">4</div>
							<div class="th npc-number">5</div>
							<div class="th npc-number">6</div>
							<div class="th npc-number">7</div>
							<div class="th npc-number">8</div>
							<div class="th npc-number">9</div>
							<div class="th npc-number">10</div>
							<div class="th npc-number">11</div>
							<div class="th npc-number">12</div>
							<div class="th npc-number">13</div>
							<div class="th npc-number">14</div>
							<div class="th npc-number">15</div>
							<div class="th npc-number">16</div>
							<div class="th npc-number">17</div>
							<div class="th npc-number">18</div>
							<div class="th npc-number">19</div>
							<div class="th npc-number">20</div>
						</div>
					{{#npcs}}
						<div class="line">
							<div class="td npc-class">{{class}}</div>
						{{#levels}}
							<div class="td table_data npc-number">{{#count}}{{count}}{{/count}}{{^count}}-{{/count}}</div>
						{{/levels}}
						</div>
					{{/npcs}}
					</div>
				</div>
			</div>
		{{/power_centers}}
		</div>
	{{/power_centers_exists}}

	{{! guilds }}
	{{#guilds_count}}
		<div class="center toggleable group-title" data-toggle-target="#guilds"><h1>Guilds</h1></div>

		<div id="guilds" class="toggled-closed">
			{{#guilds}}
				<div class="guild">{{guild}} : {{total}}</div>
			{{/guilds}}
		</div>
	{{/guilds_count}}

	<div id="layout-title" class="center toggleable group-title" data-toggle-target="#layout-container-container"><h1>City Layout</h1></div>
	<div id="layout-container-container" class="toggled-closed">
		<div id="layout-container"></div><div id="layout-container-detail"></div>
	</div>
	<div class="clear"></div>
</script>

 */

CityGenGenerated.propTypes = propTypes;
CityGenGenerated.defaultProps = defaultProps;

export default withRoot(withRouter(connect(mapStateToProps)(CityGenGenerated)));
