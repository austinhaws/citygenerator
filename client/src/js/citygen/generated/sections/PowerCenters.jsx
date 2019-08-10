import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import ListItemDetail from "../ListItemDetail";
import PowerCenterDetail from "./PowerCenterDetail";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class PowerCenters extends React.Component {

	constructor(props) {
		super(props);

		this.state = {
			openSections: {}
		};

	}

	isSectionOpen = section => {
		if (this.state.openSections[section] === undefined) {
			this.state.openSections[section] = false;
		}
		return this.state.openSections[section];
	};

	toggleSection = sectionName => this.setState({openSections: Object.assign({}, this.state.openSections, {[sectionName]: !this.state.openSections[sectionName]})});

	render() {
		const {classes, city} = this.props;
		return (
			<React.Fragment>
				{
					city.powerCenters && city.powerCenters.length ? (
						city.powerCenters.map((powerCenter, i) => (
							<ListItemDetail
								className={classes.subCollapsibleSectionTitle}
								isSubSection={true}
								key={i}
								title={() => powerCenter.type}
								isExpanded={this.isSectionOpen(i)}
								onToggleExpanded={() => this.toggleSection(i)}
								classes={classes}
								detail={() => <PowerCenterDetail powerCenter={powerCenter}/>}
							/>
						))) : <div>City has no notable centers of power</div>
				}
			</React.Fragment>
		);
	}
}

PowerCenters.propTypes = propTypes;
PowerCenters.defaultProps = defaultProps;

export default withRoot(PowerCenters);
