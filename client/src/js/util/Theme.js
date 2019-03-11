import {createMuiTheme} from '@material-ui/core/styles';
import green from "@material-ui/core/es/colors/green";

// http://paletton.com/#uid=73m1e0kuR--j8HyozCc-GrrDblv
// Primary //
const primaryShade0 = '#0A92AB';
const primaryShade1 = '#51B1C3';
const primaryShade2 = '#2D9EB3';
const primaryShade3 = '#037287';
const primaryShade4 = '#025969';

// Accent //
const secondaryShade0 = '#6913B8';
const secondaryShade1 = '#965BCC';
const secondaryShade2 = '#7E37BF';
const secondaryShade3 = '#510993';
const secondaryShade4 = '#3F0673';

// Highlight //
const highlightShade0 = '#FFF309';
const highlightShade1 = '#FFF767';
const highlightShade2 = '#FFF53B';
const highlightShade3 = '#DBD000';
const highlightShade4 = '#ABA300';

// Detail //
const detailShade0 = '#FF8109';
const detailShade1 = '#FFB167';
const detailShade2 = '#FF9B3B';
const detailShade3 = '#DB6B00';
const detailShade4 = '#AB5400';


const textColor = '#eeeeee';

// https://material-ui.com/customization/default-theme/
export const theme = createMuiTheme({
	typography: {
		useNextVariants: true,
	},
	palette: {
		type: 'light',
		primary: {
			main: textColor,
		},
		secondary: {
			main: secondaryShade0,
		},
		background: {
			paper: primaryShade0,
			default: primaryShade0,
		},
		text: {
			primary: detailShade1,
			secondary: textColor,
			hint: highlightShade1,
			disabled: textColor,
		}
	},
});


export const styles = theme => ({
	root: {
		display: 'flex',
		flexWrap: 'wrap',
		flexDirection: 'column',
		width: '250px',
		margin: '0 auto',
	},
	formControl: {
		margin: theme.spacing.unit,
		minWidth: 120,
	},
	selectEmpty: {
		marginTop: theme.spacing.unit * 2,
	},
	buttonProgress: {
		color: green[500],
		position: 'absolute',
		top: '50%',
		left: '50%',
		marginTop: -12,
		marginLeft: -12,
	},
	slider: {
		padding: '22px 0px',
	},
});
