import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import ListItemDetail from "../ListItemDetail";
import WardDetail from "./WardDetail";

const propTypes = {
	city: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class Wards extends React.Component {

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
				{city.wards.map((ward, i) => (
					<ListItemDetail
						key={i}
						title={ward.type}
						isExpanded={this.isSectionOpen(i)}
						onToggleExpanded={() => this.toggleSection(i)}
						classes={classes}
						detail={() => <WardDetail ward={ward} classes={classes}/>}
					/>
				))}
			</React.Fragment>
		);
	}
}

Wards.propTypes = propTypes;
Wards.defaultProps = defaultProps;

export default withRoot(Wards);
