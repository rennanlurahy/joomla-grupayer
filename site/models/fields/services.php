<?php
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');

class JFormFieldServices extends JFormFieldList
{
    protected $type = 'Services';

    protected function getOptions()
    {
        $services = array();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select('*')
            ->from($db->quoteName('#__grupayer_services'))
            ->where($db->quoteName('published') . '=' . $db->quote('1'));

        $rows = $db->setQuery($query)->loadObjectlist();

        foreach ($rows as $row) {
            $services[] = array('value' => $row->code, 'text' => $row->code . " - " . $row->description);
        }

        $options = array_merge(parent::getOptions(), $services);

        return $options;
    }
}
