import '@babel/polyfill';
import React from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';
import * as PropTypes from "prop-types";
import withRoot from "../app/WithRoot";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

class CityGenGenerated extends React.Component {

	render() {
		console.log('generated!', this.props.citygen.generatedCity);
		return (
			<div>show generated city</div>
		);
	}
}

CityGenGenerated.propTypes = propTypes;
CityGenGenerated.defaultProps = defaultProps;

export default withRoot(withRouter(connect(mapStateToProps)(CityGenGenerated)));
