import React from 'react';
import {Route, Switch} from 'react-router-dom';
import CityGenForm from "../citygen/CityGenForm";
import CityGenGenerated from "../citygen/CityGenGenerated";
import Paper from "@material-ui/core/Paper";
import withRoot from "./WithRoot";

class AppRoutes extends React.Component {
	render() {
		return (
			<Paper>
				<Switch>
					<Route path="/generated" component={CityGenGenerated}/>
					<Route path="/" component={CityGenForm}/>
				</Switch>
			</Paper>
		);
	}
}

export default withRoot(AppRoutes);
