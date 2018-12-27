import '@babel/polyfill';
import React from 'react';
import {render} from 'react-dom';
import {connect, Provider} from 'react-redux';
import reduxStore from './ReduxStore';
import {BrowserRouter, withRouter} from 'react-router-dom';
import AppRoutes from './AppRoutes';
import "../../css/index.scss";

class AppClass extends React.Component {
	render() {
		return (
			<div>
				<main className="main-content-wrapper flex justify-space-between">
					<section className="section-content flex1">
						<AppRoutes {...this.props}/>
					</section>
				</main>
			</div>
		);
	}
}

const App = withRouter(connect()(AppClass));


// This will correctly set the basename so router works, if you're using a awesome vhost or not.
const app = '/citygen';
const examplePos = window.location.pathname.indexOf(app);
const baseName = examplePos === -1 ? '/' : window.location.pathname.substr(0, examplePos + examples.length);
render(<BrowserRouter basename={baseName}><Provider store={reduxStore}><App/></Provider></BrowserRouter>, document.getElementById('react'));
