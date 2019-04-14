import '@babel/polyfill';
import React from 'react';
import {render} from 'react-dom';
import {connect, Provider} from 'react-redux';
import reduxStore from '../util/ReduxStore';
import {BrowserRouter, withRouter} from 'react-router-dom';
import AppRoutes from './AppRoutes';
import MainAppBar from "./MainAppBar";
import withRoot from "./WithRoot";
import Thanks from "../citygen/Thanks";

class AppClass extends React.Component {
	render() {
		return (
			<React.Fragment>
				<MainAppBar/>
				<div className={this.props.classes.app__background}>
					<AppRoutes {...this.props}/>
				</div>
				<Thanks {...this.props}/>
			</React.Fragment>
		);
	}
}

const App = withRoot(withRouter(connect()(AppClass)));


// This will correctly set the basename so router works, if you're using a awesome vhost or not.
const app = '/citygen';
const examplePos = window.location.pathname.indexOf(app);
const baseName = examplePos === -1 ? '/' : window.location.pathname.substr(0, examplePos + examples.length);
render(<BrowserRouter basename={baseName}><Provider store={reduxStore}><App/></Provider></BrowserRouter>, document.getElementById('react'));
