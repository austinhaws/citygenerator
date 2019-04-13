import '@babel/polyfill';
import React from 'react';
import {render} from 'react-dom';
import {connect, Provider} from 'react-redux';
import reduxStore from '../util/ReduxStore';
import {BrowserRouter, withRouter} from 'react-router-dom';
import AppRoutes from './AppRoutes';
import MainAppBar from "./MainAppBar";
import withRoot from "./WithRoot";

class AppClass extends React.Component {
	render() {
		return (
			<React.Fragment>
				<MainAppBar/>
				<div className={this.props.classes.app__background}>
					<AppRoutes {...this.props}/>
				</div>
				<hr/>

				<div className={this.props.classes.thanks}>
					<div className={this.props.classes.thanks__title}>Special Thanks</div>
					<ul>
						<li>Thanks to bruno71 for ward bug spotting and ideas on ward frequency.</li>
						<li>Thanks to terrancefarrel for awesome ideas on custom wards and professions.</li>
						<li>Thanks to karrakerchris for compelling releasing layouts.</li>
						<li>Thanks to jmöller, owbrogers, and karrakerchris for suggesting custom entering population size.</li>
						<li>Please <a href="mailto:rpggenerate@gmail.com">Contact Us</a> if you have a feature you would like to see added.</li>
					</ul>
				</div>

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
