import React from 'react';

export default class Thanks extends React.Component {
	render() {
		return (
			<React.Fragment>
				<hr/>

				<div className={this.props.classes.thanks}>
					<div className={this.props.classes.thanks__title}>Special Thanks</div>
					<ul>
						<li>bruno71 for ward bug spotting and ideas on ward frequency</li>
						<li>terrancefarrel for awesome ideas on custom wards and professions</li>
						<li>karrakerchris for compelling releasing layouts</li>
						<li>jmöller, owbrogers, and karrakerchris for suggesting custom entering population size</li>
						<li>Please <a href="mailto:rpggenerate@gmail.com" target="_blank">Contact Us</a> if you have a feature you would like to see added</li>
					</ul>
				</div>
			</React.Fragment>
		)
	}
}
