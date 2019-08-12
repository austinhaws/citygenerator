import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class Guilds extends React.Component {

	render() {
		const {classes, city} = this.props;
		return  (city.guilds && city.guilds.length) ? (
			<div className={classes.professions}>
				{city.guilds.map(guild=> <div
					key={guild.guild}
					className={classes.professionDetail}
				>
					{guild.guild} : {guild.total}
				</div> )}
				{Array(city.guilds.length % 4).fill('').map((_, i) => <div
					key={`filler${i}`}
					className={classes.professionDetail}
				/>)}
			</div>
		) : <div>City has no notable Guilds</div>;
	}
}

Guilds.propTypes = propTypes;
Guilds.defaultProps = defaultProps;

export default withRoot(Guilds);
