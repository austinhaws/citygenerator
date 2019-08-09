import React from 'react';
import {Route, Switch} from 'react-router-dom';
import CityGenForm from "../citygen/CityGenForm";
import withRoot from "./WithRoot";
import Pages from "./Pages";

class AppRoutes extends React.Component {
	render() {
		return (
			<Switch>
				<Route path={Pages.cityGen.generated.path} render={Pages.cityGen.generated.component}/>
				<Route path={Pages.cityGen.home.path} render={Pages.cityGen.home.component}/>
				<Route path="/" component={CityGenForm}/>
			</Switch>
		);
	}
}

export default withRoot(AppRoutes);
