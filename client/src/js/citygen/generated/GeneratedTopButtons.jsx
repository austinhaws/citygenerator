import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../app/WithRoot";
import {Button} from "@material-ui/core";
import LoopIcon from '@material-ui/icons/Loop';
import {joinClassNames} from "dts-react-common";

const propTypes = {
	onBackClick: PropTypes.func.isRequired,
	onHideAllClick: PropTypes.func.isRequired,
	onPrintClick: PropTypes.func.isRequired,
	onRegenerateClick: PropTypes.func.isRequired,
	onShowAllClick: PropTypes.func.isRequired,
};
const defaultProps = {};

class GeneratedTopButtons extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			animateButton: false,
		};
	}

	generateButtonClicked = () => {
		this.setState({animateButton: true});
		setTimeout(() => this.setState({animateButton: false}), 500);
		this.props.onRegenerateClick();
	};

	render = () => {
		const {classes} = this.props;

		return (
			<div>
				<div className={classes.generated__top_buttons}>
					<Button
						variant="outlined"
						onClick={this.props.onBackClick}
						color="secondary"
					>
						Back
					</Button>
					<Button
						variant="contained"
						onClick={this.generateButtonClicked}
						color="primary"
					>
						<LoopIcon className={joinClassNames(classes.generated__top_buttons__loop_icon, this.state.animateButton && classes.generated__top_buttons__loop_icon__hover)}/> Regenerate
					</Button>
					<Button
						variant="contained"
						onClick={this.props.onPrintClick}
						color="secondary"
					>
						Print
					</Button>
				</div>
				<div className={classes.generated__top_buttons}>
					<Button
						variant="outlined"
						onClick={this.props.onShowAllClick}
						color="secondary"
						size="small"
					>
						Show All Sections
					</Button>
					<Button
						variant="outlined"
						onClick={this.props.onHideAllClick}
						color="secondary"
						size="small"
					>
						Hide All Sections
					</Button>
				</div>
			</div>
		);
	}
}

GeneratedTopButtons.propTypes = propTypes;
GeneratedTopButtons.defaultProps = defaultProps;

export default withRoot(GeneratedTopButtons);
