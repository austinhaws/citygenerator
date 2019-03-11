import React from "react";
import CssBaseline from "@material-ui/core/CssBaseline";
import MuiThemeProvider from "@material-ui/core/styles/MuiThemeProvider";
import {styles, theme} from "../util/Theme";
import {withStyles} from "@material-ui/core";

export default Component => withStyles(styles)(props => (
	<MuiThemeProvider theme={theme}>
		<CssBaseline/>
		<Component {...props} />
	</MuiThemeProvider>
));
