<?php

defined('_JEXEC') or die;

class JFormRuleCnpjCpf extends JFormRule
{
    protected $regex = '^\d{11}$|^\d{14}$';

    public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
    {
        $app = JFactory::getApplication();
        $required = (string) $element['required'];

        // Check for a valid regex.
        if (empty($this->regex)) {
            throw new \UnexpectedValueException(sprintf('%s has invalid regex.', get_class($this)));
        }

        // Add unicode property support if available.
        if (JCOMPAT_UNICODE_PROPERTIES) {
            $this->modifiers = (strpos($this->modifiers, 'u') !== false) ? $this->modifiers : $this->modifiers . 'u';
        }

        if($required === '0' && empty($value)){
            return true;
        }

        if($required === '1' && empty($value)){
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJCPF_FORMAT_ERROR_EMPTY'));

            return false;
        }

        if(!is_string($value)){
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJCPF_FORMAT_STRING_ERROR'));
            $app->enqueueMessage(is_string($value));

            return false;
        }

        // Test the value against the regular expression.
        if (!preg_match(chr(1) . $this->regex . chr(1) . $this->modifiers, $value)) {
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJCPF_FORMAT_ERROR'));

            return false;
        }

        $this->regex = '(\d)\1{10}';

        if (preg_match(chr(1) . $this->regex . chr(1) . $this->modifiers, $value)) {
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJCPF_FORMAT_REPEATED_NUMBERS_ERROR'));

            return false;
        }

        if (strlen($value) <= 11) {
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $value[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($value[$c] != $d) {
                    $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CPF_ERROR'));

                    return false;
                }
            }
        }

        if (strlen($value) > 11) {

            $cnpj = $value;

            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
                $soma += (int) $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }

            $resto = $soma % 11;

            if ((int) $cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)){
                $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJ_ERROR'));

                return false;
            }

            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
                $soma += (int) $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }

            $resto = $soma % 11;

            if((int) $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto)){
                return true;
            }

            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_CNPJ_ERROR'));

            return false;
        }

        return true;
    }
}
