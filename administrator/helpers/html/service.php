<?php
defined('_JEXEC') or die;

abstract class JHtmlService
{
    public static function published($value, $i, $published = true, $checkbox = 'cb')
	{
		$states = array(
			1 => array(
				'unpublish_input',
				'COM_BANNERS_BANNERS_PINNED',
				'COM_GRUPAYER_PUBLISHED_TIP',
				'COM_BANNERS_BANNERS_PINNED',
				true,
				'publish',
				'publish'
			),
			0 => array(
				'publish_input',
				'COM_BANNERS_BANNERS_UNPINNED',
				'COM_GRUPAYER_UNPUBLISHED_TIP',
				'COM_BANNERS_BANNERS_UNPINNED',
				true,
				'unpublish',
				'unpublish'
			),
		);

		return JHtml::_('jgrid.state', $states, $value, $i, 'services.', $published, true, $checkbox);
	}
}
