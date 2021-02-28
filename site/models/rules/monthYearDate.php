<?php

defined('_JEXEC') or die;

class JFormRuleMonthYearDate extends JFormRule
{

    protected $regex = '^\d{6}$';
    protected $day = null;
    protected $month = null;
    protected $year = null;

    public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
	{
        $app = JFactory::getApplication();
        
        $this->month = (int) substr($value, 0, 2);
        $this->year = (int) substr($value, 2, 4);
        $required = (string) $element['required'];

		// Check for a valid regex.
		if (empty($this->regex))
		{
			throw new \UnexpectedValueException(sprintf('%s has invalid regex.', get_class($this)));
		}

		// Add unicode property support if available.
		if (JCOMPAT_UNICODE_PROPERTIES)
		{
			$this->modifiers = (strpos($this->modifiers, 'u') !== false) ? $this->modifiers : $this->modifiers . 'u';
		}

        if($required === '0' && empty($value)){
            return true;
        }

        if($required === '1' && empty($value)){
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_MONTHYEARDATE_ERROR_EMPTY'));

            return false;
        }

        if(!is_string($value)){
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_MONTHYEAR_FORMAT_STRING_ERROR'));

            return false;
        }

		// Test the value against the regular expression.
		if (!preg_match(chr(1) . $this->regex . chr(1) . $this->modifiers, $value))
		{
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_MONTHYEARDATE_FORMAT_ERROR'));
    
			return false;
		}

        if ($this->month > 12)
		{
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_MONTHYEARDATE_FORMAT_MONTH_ERROR'));
    
			return false;
		}

		return true;
	}
}