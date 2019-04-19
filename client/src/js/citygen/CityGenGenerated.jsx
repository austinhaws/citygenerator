import '@babel/polyfill';
import React from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router-dom';
import * as PropTypes from "prop-types";
import withRoot from "../app/WithRoot";
import {Button} from "@material-ui/core";
import Pages from "../app//Pages";

const propTypes = {
	citygen: PropTypes.object.isRequired,
	history: PropTypes.object.isRequired,
};
const defaultProps = {};
const mapStateToProps = state => ({ citygen: state.citygen });

class CityGenGenerated extends React.Component {

	render() {
		const {classes} = this.props;

		console.log('generated!', this.props.citygen.generatedCity);
		return (
			<div>
				<div className={classes.generated__top_buttons}>
					<Button
						variant="contained"
						onClick={() => Pages.cityGen.home.forward(this.props.history)}
						color="secondary"
					>
						Back
					</Button>
					<Button
						variant="contained"
						onClick={() => alert('Regenerating...')}
						color="primary"
					>
						Regenerate
					</Button>
					<Button
						variant="contained"
						onClick={() => alert('Print...')}
						color="secondary"
					>
						Print
					</Button>
				</div>
			</div>
		);
	}
}

CityGenGenerated.propTypes = propTypes;
CityGenGenerated.defaultProps = defaultProps;

export default withRoot(withRouter(connect(mapStateToProps)(CityGenGenerated)));
