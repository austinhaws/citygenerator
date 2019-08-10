import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import format from "../Format";
import LabelValueList from "../LabelValueList";
import {joinClassNames} from "dts-react-common";


const propTypes = {
	powerCenter: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class PowerCenterDetail extends React.Component {

	render() {
		const {classes} = this.props;
		return (
			<React.Fragment>
				<LabelValueList items={
					[
						{label: 'Alignment', value: this.props.powerCenter.alignment},
						{label: 'Wealth', value: format.formatGP(this.props.powerCenter.wealth)},
						{label: 'Influence Points', value: this.props.powerCenter.influencePoints},
						{label: 'Total NPCs', value: this.props.powerCenter.npcsTotal || 0},
					]
				}/>
				{this.props.powerCenter.npcs && this.props.powerCenter.npcs.length ? (
					<div className={classes.powerCenters}>
						<div className={classes.powerCenterLine}>
							<div key="npc" className={joinClassNames(classes.powerCenterLineCell, classes.powerCenterLineCellFirst, classes.blackColor)}>&darr; NPC \ Level &rarr;</div>
							{Array(20).fill('•').map((_, i) => <div key={i} className={joinClassNames(classes.powerCenterLineCell, classes.blackColor)}>{i + 1}</div>)}
						</div>
						{
							this.props.powerCenter.npcs.map(npc => (
								<div key={npc.class} className={classes.powerCenterLine}>
									<div key="npc" className={joinClassNames(classes.powerCenterLineCell, classes.powerCenterLineCellFirst)}>{npc.class}</div>
									{npc.levels.map(level => (
										<div key={level.level} className={classes.powerCenterLineCell}>{level.count}</div>
									))}
								</div>
							))
						}
					</div>
				) : undefined}
			</React.Fragment>
		);
	}
}

PowerCenterDetail.propTypes = propTypes;
PowerCenterDetail.defaultProps = defaultProps;

export default withRoot(PowerCenterDetail);
