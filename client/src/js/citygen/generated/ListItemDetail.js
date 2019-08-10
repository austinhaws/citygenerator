import React from "react";
import * as PropTypes from "prop-types";
import ListItem from "@material-ui/core/ListItem";
import ListItemText from "@material-ui/core/ListItemText";
import ExpandLess from '@material-ui/icons/ExpandLess';
import ExpandMore from '@material-ui/icons/ExpandMore';
import Collapse from "@material-ui/core/Collapse";
import List from "@material-ui/core/List";
import withRoot from "../../app/WithRoot";
import joinClassNames from "dts-react-common/common/JoinClassNames";

const propTypes = {
	isExpanded: PropTypes.bool.isRequired,
	onToggleExpanded: PropTypes.func.isRequired,
	title: PropTypes.func.isRequired,
	detail: PropTypes.func.isRequired,
	classes: PropTypes.object.isRequired,
	isSubSection: PropTypes.bool,
};

const defaultProps = {
	isSubSection: false,
};

class ListItemDetail extends React.Component {
	render() {
		const {classes} = this.props;
		return (
			<React.Fragment>
				<ListItem button onClick={this.props.onToggleExpanded}>
					<ListItemText primary={this.props.title()} classes={{primary: joinClassNames(classes.labelValue_container_title, this.props.isSubSection && classes.subCollapsibleSectionTitle)}}/>
					{this.props.isExpanded ? <ExpandLess /> : <ExpandMore />}
				</ListItem>
				<Collapse in={this.props.isExpanded} timeout="auto" unmountOnExit>
					<List component="ul" disablePadding>
						<ListItem className={classes.generated_list_nested}>
							<ListItemText inset>{this.props.isExpanded ? this.props.detail() : null}</ListItemText>
						</ListItem>
					</List>
				</Collapse>
			</React.Fragment>
		);
	}
}

ListItemDetail.propTypes = propTypes;

ListItemDetail.defaultProps = defaultProps;

export default withRoot(ListItemDetail);
