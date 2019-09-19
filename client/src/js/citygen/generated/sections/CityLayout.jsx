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

	render() {
		const {classes, city} = this.props;
		return  (
			<div className={classes.professions}>
				Show layout here
			</div>
		);
	}
}

CityLayout.propTypes = propTypes;
CityLayout.defaultProps = defaultProps;

export default withRoot(CityLayout);
