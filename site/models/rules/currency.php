<?php

defined('_JEXEC') or die;

class JFormRuleCurrency extends JFormRule
{
	public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
        $app = JFactory::getApplication();
        $required = (string) $element['required'];

        if($required === '0' && $value === 0){
            return true;
        }

        if($required === '1' && $value === 0){
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CURRENCY_FORMAT_EMPTY'));

            return false;
        }

        if(!is_numeric($value))
        {
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CURRENCY_FORMAT_ERROR'));

            return false;
        }

        if($value < 0)
        {
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CURRENCY_FORMAT_POSITIVE_ERROR'));

            return false;
        }

		return true;
	}
}