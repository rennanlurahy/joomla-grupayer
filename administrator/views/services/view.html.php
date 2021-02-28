<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class GruPayerViewServices extends JViewLegacy
{
    function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');
        $this->sortDirection = $this->state->get('list.direction');
        $this->sortColumn = $this->state->get('list.ordering');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->canDo = JHelperContent::getActions('com_grupayer');

        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);
        }

        // Set the submenu
		GruPayerHelper::addSubmenu('services');

        $this->addToolBar();

        parent::display($tpl);
    }

    protected function addToolBar()
    {
        JToolbarHelper::title(JText::_('COM_GRUPAYER_COMPONENT_TITLE'));

        if ($this->canDo->get('core.create')) {
            JToolbarHelper::addNew('service.add');
        }

        if ($this->canDo->get('core.edit')) {
            JToolbarHelper::editList('service.edit');
        }

        if ($this->canDo->get('core.edit.state')) {
            JToolbarHelper::custom('services.publish_input', 'publish', '', 'COM_GRUPAYER_TOOLBAR_BUTTON_PUBLISH');
        }

        if ($this->canDo->get('core.edit.state')) {
            JToolbarHelper::custom('services.unpublish_input', 'unpublish', '', 'COM_GRUPAYER_TOOLBAR_BUTTON_UNPUBLISH');
        }

        if ($this->canDo->get('core.delete')) {
            JToolbarHelper::deleteList('Are you sure?', 'services.delete');
        }

        if (JFactory::getUser()->authorise('core.admin', 'com_grupayer')) {
            JToolBarHelper::divider();
            JToolBarHelper::preferences('com_grupayer');
        }
    }
}
