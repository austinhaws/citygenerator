import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import format from "../Format";

const propTypes = {
	ward: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class WardDetail extends React.Component {

	render() {
		const {classes, ward} = this.props;
		return <React.Fragment>
			<div>
				{format.formatFloat(ward.acres)} Acres; {ward.buildings ? ward.buildings : 0} Structures; {ward.insideWalls ? 'Inside' : 'Outside'} Walls
			</div>

			<div>
				{_.map(ward.buildings, (value, key) => <div key={key}>{key} : {value}</div>)}
			</div>
		</React.Fragment>;
	}
}

WardDetail.propTypes = propTypes;
WardDetail.defaultProps = defaultProps;

export default withRoot(WardDetail);
