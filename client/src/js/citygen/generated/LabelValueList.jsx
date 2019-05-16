import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../app/WithRoot";
import LabelValue from "./LabelValue";
import constants from "./Constants";

const propTypes = {
	items: PropTypes.array.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class LabelValueList extends React.Component {

	render() {
		const {classes} = this.props;
		return this.props.items.map((item, i) => (
			item === constants.br ?
				<div key={i} className={classes.labelValue_container_br}/> :
				<LabelValue key={item.label} classes={classes} label={item.label} value={item.value}/>
		));
	}
}

LabelValueList.propTypes = propTypes;
LabelValueList.defaultProps = defaultProps;

export default withRoot(LabelValueList);
