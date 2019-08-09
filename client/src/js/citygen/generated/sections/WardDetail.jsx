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
		const qualityDescriptions = {
			A: ['Luxurious', 'Royal', 'Imperial'],
			B: ['Tasteful', 'Ornate', 'Artistic'],
			C: ['Utilitarian', 'Basic', 'Normal'],
			D: ['Derelict', 'Condemned', 'Functional'],
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
								<div key="qualityDescription" className={classes.ward_building_quality_description}>{qualityDescriptions[quality].map(description => <p key={description} className={classes.ward_quality_buildings_line}>{description}</p>)}</div>
								{
									Object.keys(buildingCountsByQuality[quality])
										.sort()
										.map(title => <div className={classes.ward_building} key={title}>{title} : {buildingCountsByQuality[title]}</div>)
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
