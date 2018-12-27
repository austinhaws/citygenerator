import React from 'react';
import {Route, Switch} from 'react-router-dom';

class AppRoutes extends React.Component {
	render() {
		return (
			<Switch>
				<Route path="/" render={() => <div>'Hello World!'</div>}/>
			</Switch>
		);
	}
}

export default AppRoutes;