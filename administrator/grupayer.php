<?php

//No direct access to this file
defined('_JEXEC') or die('Restricted access');

if (!JFactory::getUser()->authorise('core.manage', 'com_grupayer')) {
    throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Require helper file
JLoader::register('GruPayerHelper', JPATH_COMPONENT . '/helpers/grupayer.php');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

$controller = JControllerLegacy::getInstance('GruPayer');

$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

$controller->redirect();
