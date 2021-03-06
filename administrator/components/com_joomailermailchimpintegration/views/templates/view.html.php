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

class joomailermailchimpintegrationsViewTemplates extends JView
{

    function display($tpl = null)
    {
	$params =& JComponentHelper::getParams( 'com_joomailermailchimpintegration' );
	$paramsPrefix = (version_compare(JVERSION,'1.6.0','ge')) ? 'params.' : '';
	$MCapi  = $params->get( $paramsPrefix.'MCapi' );
	$MCauth = new MCauth();

        if ( !$MCapi || !$MCauth->MCauth() ) {
	    JToolBarHelper::title(   JText::_( 'JM_NEWSLETTER' ).' : '.JText::_( 'JM_UPLOAD_TEMPLATE' ), 'MC_logo_48.png' );
	    $user =& JFactory::getUser();
	    if ( (version_compare(JVERSION,'1.6.0','ge') && $user->authorise('core.admin', 'com_joomailermailchimpintegration'))
		|| !version_compare(JVERSION,'1.6.0','ge') ) {
		    JToolBarHelper::preferences('com_joomailermailchimpintegration', '350');
		    JToolBarHelper::spacer();
	    }
	} else {

	    $layout = JRequest::getVar('layout',  0, '', 'string');
	    if ( $layout == 'upload' ) {
		JToolBarHelper::title(   JText::_( 'JM_NEWSLETTER' ).' : '.JText::_( 'JM_UPLOAD_TEMPLATE' ), 'MC_logo_48.png' );
		JToolBarHelper::custom( 'start_upload', 'upload_32', 'upload_32', 'JM_START_UPLOAD', false, false );
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
	    } else if ( $layout == 'edit' ) {
		JToolBarHelper::title(   JText::_( 'JM_NEWSLETTER' ).' : '.JText::_( 'JM_EDIT_TEMPLATE' ), 'MC_logo_48.png' );
		JToolBarHelper::save();
		JToolBarHelper::spacer();
		JToolBarHelper::cancel();
		JToolBarHelper::spacer();
		// Get data from the model
		$palettes = & $this->get( 'Palettes' );
		$this->assignRef('palettes', $palettes);
	    } else {
		JToolBarHelper::title(   JText::_( 'JM_NEWSLETTER' ).' : '.JText::_( 'JM_EMAIL_TEMPLATES' ), 'MC_logo_48.png' );
		JToolBarHelper::addNewX( 'add','JM_UPLOAD_TEMPLATE');
		JToolBarHelper::spacer();
		JToolBarHelper::editListX();
		JToolBarHelper::spacer();
		JToolBarHelper::deleteList( JText::_('JM_ARE_YOU_SURE_TO_DELETE_THIS_TEMPLATE'));
		JToolBarHelper::spacer();
		$document = & JFactory::getDocument();
		$document->addScript(JURI::base().'components/com_joomailermailchimpintegration/assets/js/download.js');
	    }
	
	}

	$items		= & $this->get( 'Data');
	$this->assignRef('items', $items);

	parent::display($tpl);
	require_once( JPATH_COMPONENT.DS.'helpers'.DS.'footer.php' );
    }
}
