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
			<div className={classes.professions}>
				{city.professions.map(profession => <div
					key={profession.profession}
					className={classes.professionDetail}
				>
					{profession.profession} : {profession.total}
				</div> )}
				{Array(city.professions.length % 4).fill('').map((_, i) => <div
					key={`filler${i}`}
					className={classes.professionDetail}
				/>)}
			</div>
		);
	}
}

Professions.propTypes = propTypes;
Professions.defaultProps = defaultProps;

export default withRoot(Professions);
