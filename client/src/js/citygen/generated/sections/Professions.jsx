import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class Professions extends React.Component {

	render() {
		const {classes, city} = this.props;
		return (
			<React.Fragment>
				I'll give you a profession!!!
			</React.Fragment>
		);
	}
}

Professions.propTypes = propTypes;
Professions.defaultProps = defaultProps;

export default withRoot(Professions);
