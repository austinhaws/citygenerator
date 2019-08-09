import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import format from "../Format";
import {Tooltip} from "@material-ui/core";


const propTypes = {
	ward: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class WardDetail extends React.Component {

	render() {
		const {classes, ward} = this.props;
		const qualityDescriptions = {
			A: {title: 'Royal', detail: 'Luxurious, Royal, or Imperial'},
			B: {title: 'Tasteful', detail: 'Tasteful, Ornate, or Artistic'},
			C: {title: 'Normal', detail: 'Utilitarian, Basic, or Normal'},
			D: {title: 'Rough', detail: 'Derelict, Condemned, Rough, or Functional'},
		};

		const buildingCountsByQuality = _.castArray(ward.buildings)
			.reduce((buildingCountsByQuality, building) => {
				const title = `${building.building}${building.subType ? ` - ${building.subType}` : ''}`;
				buildingCountsByQuality[building.quality][title] = (buildingCountsByQuality[building.quality][title] || 0) + 1;
				return buildingCountsByQuality;
			}, {A: {}, B: {}, C: {}, D: {}});

		return <React.Fragment>
			<div className={classes.ward_info}>
				<div className={classes.ward_stats}>{format.formatFloat(ward.acres)} Acres; {ward.buildings ? ward.buildings.length : 0} Structures; {ward.insideWalls ? 'Inside' : 'Outside'} Walls</div>
				<div className={classes.ward_quality_buildings}>
					{
						Object.keys(qualityDescriptions).map(quality => <div key={quality} className={classes.ward_building_quality}>
								<div key="qualityDescription" className={classes.ward_building_quality_description}>
									<Tooltip title={qualityDescriptions[quality].detail} placement="top"><span>{qualityDescriptions[quality].title}</span></Tooltip>
								</div>
								{
									Object.keys(buildingCountsByQuality[quality])
										.sort()
										.map(title => <div className={classes.ward_building} key={title}>{title} : {buildingCountsByQuality[quality][title]}</div>)
								}
							</div>
						)
					}
				</div>
			</div>
		</React.Fragment>;
	}
}

WardDetail.propTypes = propTypes;
WardDetail.defaultProps = defaultProps;

export default withRoot(WardDetail);
