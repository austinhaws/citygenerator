import React from 'react';
import {Route, Switch} from 'react-router-dom';
import CityGenForm from "../citygen/CityGenForm";
import CityGenGenerated from "../citygen/CityGenGenerated";
import withRoot from "./WithRoot";

class AppRoutes extends React.Component {
	render() {
		return (
			<Switch>
				<Route path="/generated" component={CityGenGenerated}/>
				<Route path="/" component={CityGenForm}/>
			</Switch>
		);
	}
}

export default withRoot(AppRoutes);
