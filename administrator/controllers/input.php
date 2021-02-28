<?php
defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

class GruPayerControllerInput extends JControllerForm
{
    protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}

    protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) )
		{
			return JFactory::getUser()->authorise( "core.edit", "com_grupayer.input." . $id );
		}
	}
}
