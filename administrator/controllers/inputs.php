<?php
defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

class GruPayerControllerInputs extends JControllerAdmin
{
    public function __construct($config = array())
	{
		parent::__construct($config);

		$this->registerTask('enable_input', 'disable_input');
		$this->registerTask('require_input', 'not_require_input');
		$this->registerTask('publish_input', 'unpublish_input');
	}

	public function getModel($name = 'Input', $prefix = 'GruPayerModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}

    public function disable_input()
	{
		// Check for request forgeries.
		$this->checkToken();

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('enable_input' => 0, 'disable_input' => 1);
		$task   = $this->getTask();
		$value  = ArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('COM_GRUPAYER_NO_INPUTS_SELECTED'));
		}
		else
		{
			// Get the model.
			/** @var GruPayerModelInput $model */
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->disable($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_DISABLED';
				}
				else
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_ENABLED';
				}

				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_grupayer&view=inputs');
	}

    public function not_require_input()
	{
		// Check for request forgeries.
		$this->checkToken();

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('require_input' => 1, 'not_require_input' => 0);
		$task   = $this->getTask();
		$value  = ArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('COM_GRUPAYER_NO_INPUTS_SELECTED'));
		}
		else
		{
			// Get the model.
			/** @var GruPayerModelInput $model */
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->require($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_REQUIRED';
				}
				else
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_NOT_REQUIRED';
				}

				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_grupayer&view=inputs');
	}

    public function unpublish_input()
	{
		// Check for request forgeries.
		$this->checkToken();

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('publish_input' => 1, 'unpublish_input' => 0);
		$task   = $this->getTask();
		$value  = ArrayHelper::getValue($values, $task, 0, 'int');

		if (empty($ids))
		{
			JError::raiseWarning(500, JText::_('COM_GRUPAYER_NO_INPUTS_SELECTED'));
		}
		else
		{
			// Get the model.
			/** @var GruPayerModelInput $model */
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->publish($ids, $value))
			{
				JError::raiseWarning(500, $model->getError());
			}
			else
			{
				if ($value == 1)
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_PUBLISHED';
				}
				else
				{
					$ntext = 'COM_GRUPAYER_N_ITEMS_UNPUBLISHED';
				}

				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect('index.php?option=com_grupayer&view=inputs');
	}
}
