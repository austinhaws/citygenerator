import '@babel/polyfill';
import React from 'react';
import * as PropTypes from "prop-types";
import withRoot from "../../app/WithRoot";
import {Button} from "@material-ui/core";

const propTypes = {
	onBackClick: PropTypes.func.isRequired,
	onHideAllClick: PropTypes.func.isRequired,
	onPrintClick: PropTypes.func.isRequired,
	onRegenerateClick: PropTypes.func.isRequired,
	onShowAllClick: PropTypes.func.isRequired,
};
const defaultProps = {};

class GeneratedTopButtons extends React.Component {

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
						onClick={this.props.onRegenerateClick}
						color="primary"
					>
						Regenerate
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
