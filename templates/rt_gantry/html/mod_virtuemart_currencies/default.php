<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<!-- Currency Selector Module -->
<?php echo $text_before ?>
<form action="<?php echo JURI::getInstance()->toString(); ?>" method="post" id="currency">
	<?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="inputbox"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
    <input style="display:none" class="button" type="submit" name="submit_currency" value="<?php echo JText::_('MOD_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?>" />
</form>
