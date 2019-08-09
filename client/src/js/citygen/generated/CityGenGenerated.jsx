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
import CityDetail from "./sections/CityDetail";
import Wards from "./sections/Wards";
import Professions from "./sections/Professions";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

const SECTIONS = {
	CITY_DETAIL: 'cityDetail',
	PROFESSIONS: 'professions',
	WARDS: 'wards',
};

class CityGenGenerated extends React.Component {

	constructor(props) {
		super(props);

		this.state = {
			openSections: {..._.reduce(SECTIONS, (carry, value, key) => {
				carry[value] = false;
				return carry;
			}, {}), ...{[SECTIONS.CITY_DETAIL]: true}},
		};

		if (!this.props.citygen.generatedCity) {
			this.generate();
		}
	}

	toggleSection = sectionName => this.setState({openSections: Object.assign({}, this.state.openSections, {[sectionName]: !this.state.openSections[sectionName]})});

	generate = () => webservice.citygen.generate();

	closeSections = () => this.setState({openSections: _.mapValues(this.state.openSections, () => false)});
	openSections = () => this.setState({openSections: _.mapValues(this.state.openSections, () => true)});

	render() {
		const {classes} = this.props;
		const city = this.props.citygen.generatedCity;

		const sections = [
			{
				section: SECTIONS.CITY_DETAIL,
				title: 'City Detail',
				render: () => <CityDetail key="cityDetail" city={city}/>
			},
			{
				section: SECTIONS.WARDS,
				title: 'Wards',
				render: () => <Wards city={city}/>
			},
			{
				section: SECTIONS.PROFESSIONS,
				title: 'Professions',
				render: () => <Professions city={city}/>
			},
		];

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
					{sections.map(section => <ListItemDetail
						key={section.section}
						title={section.title}
						isExpanded={this.state.openSections[section.section]}
						onToggleExpanded={() => this.toggleSection(section.section)}
						classes={classes}
						detail={section.render}
					/>)}
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
