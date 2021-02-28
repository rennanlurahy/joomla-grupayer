<?php

defined('_JEXEC') or die('Restricted access');

abstract class GruPayerHelper extends JHelperContent
{
	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_GRUPAYER_SUBMENU_FORM'),
			'index.php?option=com_grupayer',
			$submenu == 'form'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_GRUPAYER_SUBMENU_SERVICES'),
			'index.php?option=com_grupayer&view=services',
			$submenu == 'services'
		);
	}
}