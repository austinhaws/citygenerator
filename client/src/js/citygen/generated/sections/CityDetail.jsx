import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import LabelValue from "./../LabelValue";
import LabelValueList from "./../LabelValueList";
import constants from './../Constants';
import format from "./../Format";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class CityDetail extends React.Component {

	render() {
		const {classes} = this.props;
		const city = this.props.city;
		return (
			<React.Fragment>
				<LabelValueList items={
					[
						{label: 'Community Size', value: city.populationType},
						{label: 'Population', value: `${city.populationSize} Adults`},
						{label: 'Size', value: `${format.formatFloat(city.acres)} Acres`},
						{label: 'Population Density (Adults/Acre)', value: `${city.populationDensity} Adults/Acre`},
						{
							label: 'Races', value: city.races
								.filter(race => race.total)
								.map(race => <span key={race.race}>{race.race} ({race.total})</span>)
								.reduce((prev, curr, i) => [prev, <br key={`br-${i}`}/>, curr])
						},
						constants.br,

						{label: 'Gold Piece Limit', value: format.formatGP(city.goldPieceLimit)},
						{label: 'Wealth', value: format.formatGP(city.wealth)},
						{label: 'Income for Lord(s)/King(s)', value: format.formatGP(city.kingIncome)},
						{label: 'Magic Resources', value: format.formatGP(city.magicResources)},
						constants.br,

						{label: 'Imports', value: format.formatList(city.commoditiesImport)},
						{label: 'Exports', value: format.formatList(city.commoditiesExport)},
						{label: 'Famous', value: format.formatList(city.famous)},
						{label: 'Infamous', value: format.formatList(city.infamous)},
						constants.br,

						{label: '# of Guilds', value: city.guilds.length},
						{label: 'Walls', value: city.numGates ? 'Has Walls' : 'No Walls'},
					]
				}/>

				{city.numGates ? <LabelValue classes={classes} label="# of Gates" value={city.numGates}/> : undefined}
			</React.Fragment>

		);
	}
}

CityDetail.propTypes = propTypes;
CityDetail.defaultProps = defaultProps;

export default withRoot(CityDetail);
