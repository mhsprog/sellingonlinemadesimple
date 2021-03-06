<?php
/**
 * Virtuemart Product Ratings table
 *
 * @package		CSVI
 * @author 		Roland Dalmulder
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: rating_votes.php 1924 2012-03-02 11:32:38Z RolandD $
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
* @package CSVI
 */
class TableRating_votes extends JTable {

	/**
	 * Table constructor
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		4.0
	 */
	public function __construct($db) {
		parent::__construct('#__virtuemart_rating_votes', 'virtuemart_rating_vote_id', $db );
	}

	/**
	 * Check if there is already an existing review by the user
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		3.0
	 */
	 public function check() {
	 	// See if we already have review id
		if (empty($this->virtuemart_rating_vote_id)) {
			$jinput = JFactory::getApplication()->input;
			$db = JFactory::getDBO();
			$csvilog = $jinput->get('csvilog', null, null);

			// Check if a record already exists in the database
			$q = "SELECT ".$this->_tbl_key."
				FROM ".$this->_tbl."
				WHERE virtuemart_product_id = '".$this->virtuemart_product_id."'
				AND created_by = ".$this->created_by;
			$db->setQuery($q);
			$db->query($q);
			$csvilog->addDebug(JText::_('COM_CSVI_CHECK_RATING_VOTE_EXISTS'), true);
			if ($db->getAffectedRows() > 0) {
				$this->virtuemart_rating_vote_id = $db->loadResult();
				return true;
			}
			else {
				// There is no entry yet, so we must insert a new one
				return false;
			}
		}
		// There is already a rating id
		else return true;
	 }

	/**
	 * Reset the keys including primary key
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		4.0
	 */
	public function reset() {
		// Get the default values for the class from the table.
		foreach ($this->getFields() as $k => $v) {
			// If the property is not private, reset it.
			if (strpos($k, '_') !== 0) {
				$this->$k = NULL;
			}
		}
	}
}
?>