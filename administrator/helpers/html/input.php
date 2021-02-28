<?php
defined('_JEXEC') or die;

abstract class JHtmlInput
{
	public static function disabled($value, $i, $enabled = true, $checkbox = 'cb')
	{
		$states = array(
			1 => array(
                'enable_input',
				'COM_BANNERS_BANNERS_PINNED',
				'COM_GRUPAYER_DISABLED_TIP',
				'COM_BANNERS_BANNERS_PINNED',
				true,
				'publish',
				'publish'
			),
			0 => array(
				'disable_input',
				'COM_BANNERS_BANNERS_UNPINNED',
				'COM_GRUPAYER_ENABLED_TIP',
				'COM_BANNERS_BANNERS_UNPINNED',
				true,
				'unpublish',
				'unpublish'
			),
		);

		return JHtml::_('jgrid.state', $states, $value, $i, 'inputs.', $enabled, true, $checkbox);
	}

    public static function required($value, $i, $enabled = true, $checkbox = 'cb')
	{
		$states = array(
			1 => array(
				'not_require_input',
				'COM_BANNERS_BANNERS_PINNED',
				'COM_GRUPAYER_REQUIRED_TIP',
				'COM_BANNERS_BANNERS_PINNED',
				true,
				'publish',
				'publish'
			),
			0 => array(
				'require_input',
				'COM_BANNERS_BANNERS_UNPINNED',
				'COM_GRUPAYER_NOT_REQUIRED_TIP',
				'COM_BANNERS_BANNERS_UNPINNED',
				true,
				'unpublish',
				'unpublish'
			),
		);

		return JHtml::_('jgrid.state', $states, $value, $i, 'inputs.', $enabled, true, $checkbox);
	}

    public static function published($value, $i, $enabled = true, $checkbox = 'cb')
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

		return JHtml::_('jgrid.state', $states, $value, $i, 'inputs.', $enabled, true, $checkbox);
	}
}
