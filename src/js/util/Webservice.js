import {AjaxStatusCore, WebserviceCore} from "dts-react-common";
import store from "./ReduxStore";
import {dispatchField} from "./Dispatch";

export const ajaxStatusCore = new AjaxStatusCore();
ajaxStatusCore.registerChangedCallback(
	(ajaxId, isAjaxingStarting) => dispatchField('app.ajaxSpinnerCount', store.getState().app.ajaxSpinnerCount + (isAjaxingStarting ? 1 : -1))
);

const rawPromiseCallback = promise => promise
	.then(function (response) {
		if (response.status !== 200) {
			throw response;
		}
		return response;
	})
	.catch(error => {
		axiosErrorHandler(error, true);
		throw error;
	});

const webserviceCityGen = new WebserviceCore({
	// mocked url that just returns some content
	baseUrl: 'http://localhost/citygenerator/api/public/citygenerator/',
	ajaxStatusCore: ajaxStatusCore,
	rawPromiseCallback: rawPromiseCallback,
});

/**
 * An axios catch() error handler
 * Note: Will also need to import showMessage() & app store when used.
 * @param error - Error object from axios.
 * @param displayError {boolean} - show the error to the user?
 */
export const axiosErrorHandler = (error, displayError) => {
	alert('Ajax error');
	console.error(error);
	throw error;
};


export default {
	citygen: {
		lists: () => webserviceCityGen.get(`lists`).then(lists => {
			dispatchField('citygen.lists.populationTypes', lists.populationTypes);
			return lists;
		}),
	},
};
