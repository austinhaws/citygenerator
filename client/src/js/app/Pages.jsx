import React from "react";
import CityGenForm from "../citygen/CityGenForm";
import CityGenGenerated from "../citygen/generated/CityGenGenerated";

export default {
	cityGen: {
		generated: {
			path: '/generated',
			component: () => <CityGenGenerated/>,
			forward: history => history.push(`/generated`),
		},
		home: {
			path: '/home',
			component: () => <CityGenForm/>,
			forward: history => history.push(`/home`),
		},
	},
};
