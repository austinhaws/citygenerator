import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import CityLayoutCell from "./CityLayoutCell";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class CityLayout extends React.Component {

	constructor(props) {
		super(props);
		this.blankCell = {
			wardId: undefined,
			walls: {left: false, right: false, bottom: false, top: false},
			insideWalls: false,
		};
	}

	render() {
		const {classes, city} = this.props;
		const layout = Array.from({length: city.layoutMeta.height}, i => Array.from({length: city.layoutMeta.width}, j => j));
		return  (
			<div key="city-layout" className={classes.layoutContainer}>
				{layout.map((row, i) => (
					<div key={i} className={classes.layoutRow}>
						{row.map((_, j) => <CityLayoutCell key={j} cell={city.layoutCells[i * city.layoutMeta.height + j] || this.blankCell}/>)}
					</div>
				))}
			</div>
		);
	}
}

CityLayout.propTypes = propTypes;
CityLayout.defaultProps = defaultProps;

export default withRoot(CityLayout);
