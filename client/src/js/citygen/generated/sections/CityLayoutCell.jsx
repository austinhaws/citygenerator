import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../../app/WithRoot";
import {joinClassNames} from "dts-react-common";

const propTypes = {
	cell: PropTypes.object.isRequired,
	classes: PropTypes.object.isRequired,
};
const defaultProps = {};

class CityLayoutCell extends React.Component {

	render() {
		const {classes, cell} = this.props;
console.log({cell, wardId: cell.wardId});
		return  (
			<div className={joinClassNames(
					classes.layoutCell,
					cell.walls.left && classes.layoutCell_leftWall,
					cell.walls.right && classes.layoutCell_rightWall,
					cell.walls.bottom && classes.layoutCell_bottomWall,
					cell.walls.top && classes.layoutCell_topWall
			)}>
				{cell.wardId ? 'X' : ' '}
			</div>
		);
	}
}

CityLayoutCell.propTypes = propTypes;
CityLayoutCell.defaultProps = defaultProps;

export default withRoot(CityLayoutCell);
