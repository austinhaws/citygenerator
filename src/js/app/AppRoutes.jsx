import React from 'react';
import {Route, Switch} from 'react-router-dom';
import CityGenForm from "../citygen/CityGenForm";

class AppRoutes extends React.Component {
	render() {
		return (
			<Switch>
				<Route path="/" component={CityGenForm}/>
			</Switch>
		);
	}
}

export default AppRoutes;
