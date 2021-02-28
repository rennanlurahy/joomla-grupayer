<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class GruPayerModelInput extends JModelAdmin
{
    public function getTable($type = 'Input', $prefix = 'GruPayerTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);;
    }

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_grupayer.input', 'input', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    protected function loadFormData()
    {
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState(
			'com_grupayer.input.grupayer.data',
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

    public function disable(&$pks, $value = 1)
	{
		$table = $this->getTable();
		$pks   = (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk))
			{
				if (!$this->canEditState($table))
				{
					// Prune items that you can't change.
					unset($pks[$i]);
                    JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
				}
			}
		}

		// Attempt to change the state of the records.
		if (!$table->disable($pks, $value, JFactory::getUser()->id))
		{
			$this->setError($table->getError());

			return false;
		}

		return true;
	}

    public function require(&$pks, $value = 1)
	{
		$table = $this->getTable();
		$pks   = (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk))
			{
				if (!$this->canEditState($table))
				{
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
				}
			}
		}

		// Attempt to change the state of the records.
		if (!$table->require($pks, $value, JFactory::getUser()->id))
		{
			$this->setError($table->getError());

			return false;
		}

		return true;
	}

    public function publish(&$pks, $value = 1)
	{
		$table = $this->getTable();
		$pks   = (array) $pks;

		// Access checks.
		foreach ($pks as $i => $pk)
		{
			if ($table->load($pk))
			{
				if (!$this->canEditState($table))
				{
					// Prune items that you can't change.
					unset($pks[$i]);
					JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
				}
			}
		}

		// Attempt to change the state of the records.
		if (!$table->publish($pks, $value, JFactory::getUser()->id))
		{
			$this->setError($table->getError());

			return false;
		}

		return true;
	}

    protected function canDelete($record)
	{
		if( !empty( $record->id ) )
		{
			return JFactory::getUser()->authorise( "core.delete", "com_grupayer.input." . $record->id );
		}
	}

}
