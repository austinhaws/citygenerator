import '@babel/polyfill';
import React from 'react';
import Button from '@material-ui/core/Button';
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import IconButton from "@material-ui/core/IconButton";
import MenuIcon from '@material-ui/icons/Menu';
import Typography from "@material-ui/core/Typography";
import Popper from "@material-ui/core/Popper";
import Grow from "@material-ui/core/Grow";
import Paper from "@material-ui/core/Paper";
import ClickAwayListener from "@material-ui/core/ClickAwayListener";
import MenuList from "@material-ui/core/MenuList";
import MenuItem from "@material-ui/core/MenuItem";
import withRoot from "./WithRoot";
import PropTypes from "prop-types";
import logoImage from "../../static/img/rpggenerator-logo.png";

const propTypes = {
	classes: PropTypes.object.isRequired,
};

const defaultProps = {

};

class MainAppBar extends React.Component {
	state = {
		open: false,
	};

	handleToggle = () => {
		this.setState(state => ({ open: !state.open }));
	};

	handleClose = () => {
		this.setState({ open: false });
	};

	handleMenuItem = url => {
		return event => {
			this.handleClose(event);
			window.location = url;
		};
	};

	render() {
		const { open } = this.state;

		return (
			<div>
				<AppBar position="static">
					<Toolbar>
						<IconButton
							color="inherit"
							aria-label="Menu"
							buttonRef={node => this.anchorEl = node}
							onClick={this.handleToggle}
						>
							<img src={logoImage} alt="RPG Generator logo" className={this.props.classes.appBar__logo}/>
						</IconButton>
						<IconButton
							color="inherit"
							aria-label="Menu"
							buttonRef={node => this.anchorEl = node}
							onClick={this.handleToggle}
						>
							<MenuIcon
								aria-owns={open ? 'menu-list-grow' : undefined}
								aria-haspopup="true"
							/>
						</IconButton>
						<Popper open={open} anchorEl={this.anchorEl} transition disablePortal>
							{({ TransitionProps, placement }) => (
								<Grow
									{...TransitionProps}
									id="menu-list-grow"
									style={{ transformOrigin: placement === 'bottom' ? 'center top' : 'center bottom' }}
								>
									<Paper>
										<ClickAwayListener onClickAway={this.handleClose}>
											<MenuList>
												<MenuItem onClick={this.handleMenuItem('http://rpggenerator.com')}>About Us</MenuItem>
												<MenuItem onClick={this.handleMenuItem('http://strategerygames.com/centralcasting')}>Character Generator</MenuItem>
											</MenuList>
										</ClickAwayListener>
									</Paper>
								</Grow>
							)}
						</Popper>


						<Typography variant="h6" color="inherit">
							City Generator <Button onClick={() => window.location = 'https://rpggenerator.com'}>by RPG Generator</Button>
						</Typography>
						<Button color="inherit" onClick={() => alert('Coming Soon!')}>Login</Button>
					</Toolbar>
				</AppBar>
			</div>
		);
	}
}

MainAppBar.propTypes = propTypes;
MainAppBar.defaultProps = defaultProps;

export default withRoot(MainAppBar);
