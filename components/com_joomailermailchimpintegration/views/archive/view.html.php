<?php
/**
 * Copyright (C) 2011  freakedout (www.freakedout.de)
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted Access' );

jimport( 'joomla.application.component.view');

class joomailermailchimpintegrationViewArchive extends JView
{
    function display($tpl = null)
    {

	$mainframe =& JFactory::getApplication();

	$pparams =& $mainframe->getParams('com_joomailermailchimpintegration');
	$this->assignRef('params', $pparams);

	// retrieve page title from the menuitem
	$menus =& JSite::getMenu();
	$menu  = $menus->getActive();
	$menu_params = new JParameter( $menu->params );
	$this->assignRef('page_title', $menu_params->get( 'page_title'));

	$campaigns =& $this->get( 'Campaigns');
	$this->assignRef('campaigns', $campaigns);

	parent::display($tpl);
    }
}
