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

$user = & JFactory::getUser();
$model	=& $this->getModel();

// if ( $this->params->get( 'show_page_title' ) == '1' ) {
 echo '<h2 class="componentheading">';
    if ( $this->page_title ) {
        echo $this->page_title;
    } else {
        echo JText::_( 'JM_AVAILABLE_NEWSLETTER_LISTS' );
    }
 echo '</h2>';
// }

echo '<table>';
echo '<tr><th>'.JText::_( 'JM_LIST_NAME' ).'</th><th>'.JText::_( 'JM_SUBSCRIBED' ).'</th></tr>';

foreach ($this->lists as $list){
    echo '<tr><td>'.$list['name'].'</td>';
    $is_sub =& $model->getIsSubscribed($list['id'], $user->email);
    if ($is_sub) {
        echo '<td align="center">'.JText::_( 'JM_YES' ).'</td></tr>';
    } else {
        echo '<td align="center">'.JText::_( 'JM_NO' ).'</td></tr>';
    }
}

echo '</table>';


 ?>
<br />
<br />
<a href="<?php echo $this->editlink; ?>"><?php echo JText::_( 'JM_EDIT_SUBSCRIPTIONS' );?></a>
