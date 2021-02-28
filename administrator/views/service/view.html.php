<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class GruPayerViewService extends JViewLegacy
{
    protected $form = null;

    function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->canDo = JHelperContent::getActions('com_grupayer');

        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);

            return false;
        }

        $this->addToolBar();

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JToolbarHelper::title(JText::_('COM_GRUPAYER_COMPONENT_TITLE'));
        $isNew = ($this->item->id == 0);

        if ($isNew) {
            if ($this->canDo->get('core.create')) {
                JToolbarHelper::apply('service.apply');
                JToolbarHelper::save('service.save');
            }
        } else {
            if($this->canDo->get('core.edit')) {
                JToolbarHelper::apply('service.apply');
                JToolbarHelper::save('service.save');
            }
        }

        JToolbarHelper::cancel('service.cancel');
    }
}
