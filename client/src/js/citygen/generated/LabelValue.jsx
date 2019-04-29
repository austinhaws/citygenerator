import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../app/WithRoot";

const propTypes = {
	classes: PropTypes.object.isRequired,
	label: PropTypes.string.isRequired,
	value: PropTypes.any,
};
const defaultProps = {};

class LabelValue extends React.Component {

	render() {
		return (
			<div className={this.props.classes.labelValue_container}>
				<div className={this.props.classes.labelValue_container_label}>{this.props.label}:</div>
				<div className={this.props.classes.labelValue_container_value}>{this.props.value}</div>
			</div>
		);
	}
}

LabelValue.propTypes = propTypes;
LabelValue.defaultProps = defaultProps;

export default withRoot(LabelValue);
