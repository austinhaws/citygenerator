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

const colorBlack = 'black';


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
		// backgroundImage: 'url(img/squidee-opaque.png)',
		// backgroundPositionX: 'center',
		// backgroundRepeat: 'no-repeat',
		// backgroundPositionY: '50%',
		// backgroundSize: '50%',
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
	},
	generated__top_buttons__loop_icon: {
		marginRight: '10px',
	},
	generated__top_buttons__loop_icon__hover: {
		animationName: 'spin',
		animationDuration: '500ms',
		animationTimingFunction: 'linear',
		animationFillMode: 'forwards',
		animationIterationCount: 'infinite',
	},
	'@keyframes spin': {
		to: {
			transform: 'rotate(0deg)',
		},
		from: {
			transform: 'rotate(180deg)',
		},
	},

	generated_list: {
		width: '100%',
		maxWidth: 1000,
		margin: '0 auto',
	},
	generated_list_title: {
		textAlign: 'center',
		fontWeight: 'bold',
		fontSize: '2rem',
		backgroundColor: colorPrimary1,
	},
	generated_list_nested: {
		paddingLeft: theme.spacing.unit * 4,
	},

	labelValue_container: {
		display: 'flex',
		flexDirection: 'row',
		width: '100%',
	},
	labelValue_container_title: {
		textAlign: 'center',
		color: colorComplement4,
		fontSize: '1.5rem',
		// arrow takes size from right causing center to not match city name centering
		paddingLeft: '40px',
	},
	labelValue_container_label: {
		width: '30%',
		textAlign: 'right',
		marginRight: '11px',
		color: colorBlack,
	},
	labelValue_container_value: {

	},
	labelValue_container_br: {
		height: '10px',
		width: '100%',
	},

	ward_info: {
	},
	ward_stats: {
		textAlign: 'center',
	},
	ward_building_legend: {
		fontSize: '.75rem',
	},
	ward_quality_buildings: {
		display: 'flex',
		flexDirection: 'row',
		justifyContent: 'space-between',
	},
	ward_building_quality: {
		width: '20%',
	},
	ward_building_quality_description: {
		borderBottom: '1px solid',
		cursor: 'default',
	},
	ward_quality_buildings_line: {
	},
	ward_building: {
		fontSize: '.7rem',
	},

	professions: {
		display: 'flex',
		flexDirection: 'row',
		flexWrap: 'wrap',
		justifyContent: 'space-between',
		fontSize: '.7rem',
	},

	professionDetail: {
		width: '23%',
	},

	subCollapsibleSectionTitle: {
		fontSize: '1.25rem',
	},
	subCollapsibleSectionTitleInfo: {
		fontSize: '1rem',
		paddingLeft: '8px',
	},
	subSubCollapsibleSectionTitleInfo: {
		fontSize: '.9rem',
	},

	powerCenters: {
		display: 'flex',
		flexDirection: 'column',
		fontSize: '.8rem',
	},
	powerCenterLine: {
		display: 'flex',
		justifyContent: 'space-between',
	},
	powerCenterLineCellFirst: {
		width: '100px !important',
	},
	powerCenterLineCell: {
		width: '30px',
	},
	powerCentersCell: {
		textAlign: 'center',
		width: '30px',
	},
	powerCentersCellFirst: {
		width: '100px',
	},

	blackColor: {
		color: 'black',
	},

	customWardsTop: {
		backgroundColor: colorPrimary2,
	},
	customWardsContainer: {
		width: '350px',
		overflow: 'scroll',
	},
	customWardsBlurb: {
		textAlign: 'center',
	},
	customWards: {
		display: 'flex',
		flexDirection: 'row',
	},
	customWards_Ward: {
		width: '200px',
		minWidth: '200px',
	},
	customWards_WardName: {
		color: colorComplement1,
	},
});
