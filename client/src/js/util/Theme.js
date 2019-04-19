import {createMuiTheme} from '@material-ui/core/styles';
import green from "@material-ui/core/es/colors/green";

// http://paletton.com/#uid=73q1j0kvCmBn9tXtCrLCFihMncR
// Main Primary color
const colorPrimary0 = '#065371';
const colorPrimary1 = '#0a91ab';
const colorPrimary2 = '#10698B';
const colorPrimary3 = '#03435B';
const colorPrimary4 = '#012F40';

// Main Secondary color (1)
const colorSecondary10 = '#520778';
const colorSecondary11 = '#7A329F';
const colorSecondary12 = '#681294';
const colorSecondary13 = '#420461';
const colorSecondary14 = '#2E0244';

// Main Secondary color (2)
const colorSecondary20 = '#B1B402';
const colorSecondary21 = '#ECEE42';
const colorSecondary22 = '#DADD10';
const colorSecondary23 = '#8F9100';
const colorSecondary24 = '#656600';

// Main Complement color
const colorComplement0 = '#B45F02';
const colorComplement1 = '#EF9C42';
const colorComplement2 = '#DD7B11';
const colorComplement3 = '#924C00';
const colorComplement4 = '#663500';


const textColor = '#eeeeee';

// https://material-ui.com/customization/default-theme/
export const theme = createMuiTheme({
	typography: {
		useNextVariants: true,
	},
	palette: {
		type: 'light',
		primary: {
			main: colorPrimary0,
			default: colorPrimary0,
		},
		secondary: {
			main: colorSecondary10,
			default: colorSecondary10,
		},
		background: {
			paper: colorPrimary1,
			default: colorPrimary1,
		},
		text: {
			primary: colorComplement1,
			secondary: textColor,
			hint: colorSecondary21,
			disabled: textColor,
		},
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
	appBar__logo: {
		width: '64px',
	},
	app__background: {
		backgroundImage: 'url(img/squidee-opaque.png)',
		backgroundPositionX: 'center',
		backgroundRepeat: 'no-repeat',
		backgroundPositionY: '50%',
		backgroundSize: '50%',
	},
	thanks: {
		margin: '0 auto',
		width: '50%',
	},
	thanks__title: {
		textAlign: 'center',
		fontSize: '2rem',
		fontWeight: 'bold',
		marginTop: '20px',
		marginBottom: '8px',
	},

	generated__top_buttons: {
		display: 'flex',
		justifyContent: 'space-between',
		width: '400px',
		margin: '25px auto 0',
	}
});
