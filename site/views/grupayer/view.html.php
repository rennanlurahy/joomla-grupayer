<?php

defined('_JEXEC') or die('Restricted access');

class GruPayerViewGruPayer extends JViewLegacy
{
    protected $inputs = null;
    protected $form = null;
    protected $params = null;

	public function display($tpl = null)
	{
        $this->inputs = $this->get('Inputs');
        $this->params = $this->get('Params');
        $this->form = $this->getModel()->getForm($this->inputs);

        if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}
        
		parent::display($tpl);

        $this->setDocument();
	}

    protected function setDocument() 
	{	
        JHtml::_('behavior.framework');
		JHtml::_('behavior.formvalidator');
        
		$document = JFactory::getDocument();
		$document->addStyleSheet(JURI::root() . 'components/com_grupayer/css/style.css');
		$document->addScript(JURI::root() . 'components/com_grupayer/js/utils.js');
		$document->addScript(JURI::root() . 'components/com_grupayer/js/masks.js');
		$document->addScript(JURI::root() . 'components/com_grupayer/js/transforms.js');
		$document->addScript(JURI::root() . 'components/com_grupayer/js/validators.js');
		$document->addScript(JURI::root() . 'components/com_grupayer/js/submit.js');
		$document->addScript('https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.6.6/iframeResizer.min.js');
	}
}