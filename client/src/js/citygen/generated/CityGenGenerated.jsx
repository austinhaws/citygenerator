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
import PowerCenters from "./sections/PowerCenters";
import Guilds from "./sections/Guilds";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

const SECTIONS = {
	CITY_DETAIL: 'cityDetail',
	GUILDS: 'guilds',
	POWER_CENTERS: 'powerCenters',
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
				title: () => 'City Detail',
				render: () => <CityDetail key="cityDetail" city={city}/>
			},
			{
				section: SECTIONS.WARDS,
				title: () => <div>
					<span>Wards</span>
					<span className={classes.subCollapsibleSectionTitleInfo}>(
						 Total: {(city && city.wards) ? city.wards.length : 0}; Buildings: {city && city.numberBuildings}
					 )</span>
				</div>,
				render: () => <Wards city={city}/>,
			},
			{
				section: SECTIONS.PROFESSIONS,
				title: () => (
					<div>
						<span>Professions</span>
						<span className={classes.subCollapsibleSectionTitleInfo}>(Total: {city ? city.professions.reduce((total, profession) => total + profession.total, 0) : 0})</span>
					</div>
				),
				render: () => <Professions city={city}/>
			},
			{
				section: SECTIONS.POWER_CENTERS,
				title: () => (
					<div>
						<span>Power Centers</span>
						<span className={classes.subCollapsibleSectionTitleInfo}>(Total: {(city && city.powerCenters) ? city.powerCenters.length : 0})</span>
					</div>
				),
				render: () => <PowerCenters city={city}/>
			},
			{
				section: SECTIONS.GUILDS,
				title: () => (
					<div>
						<span>Guilds</span>
						<span className={classes.subCollapsibleSectionTitleInfo}>(Total: {(city && city.guilds) ? city.guilds.reduce((total, guild) => total + guild.total, 0) : 0})</span>
					</div>
				),
				render: () => <Guilds city={city}/>
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

CityGenGenerated.propTypes = propTypes;
CityGenGenerated.defaultProps = defaultProps;

export default withRoot(withRouter(connect(mapStateToProps)(CityGenGenerated)));
