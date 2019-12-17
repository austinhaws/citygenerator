import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";

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
		return  (
			<div key="city-layout" className={classes.layoutContainer}>
				{city.layoutLines.map((row, i) => (
					<div key={i} className={classes.layoutRow}>
						{
							row
								.map(line => line.split('').map(char => char === ' ' ? '\u00A0' : char).join(''))
								.map((line, j) => <div key={j} className={classes.layoutLine}>{line}</div>)
						}
					</div>
				))}
				<div className={classes.layoutBlurb}>Letters match Ward letters in Wards section</div>
			</div>
		);
	}
}

CityLayout.propTypes = propTypes;
CityLayout.defaultProps = defaultProps;

export default withRoot(CityLayout);
