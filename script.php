<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class com_grupayerInstallerScript
{
    protected function setRules()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Fields to update.
        $fields = array(
            $db->quoteName('rules') . ' = ' . $db->quote('{"core.admin":{"1":0},"core.manage":{"1":0},"core.create":{"1":0},"core.delete":{"1":0},"core.edit":{"1":0},"core.edit.state":{"1":0}}'),
        );

        // Conditions for which records should be updated.
        $conditions = array(
            $db->quoteName('name') . ' = ' . $db->quote('com_grupayer'),
        );

        $query->update($db->quoteName('#__assets'))->set($fields)->where($conditions);

        $db->setQuery($query);

        $result = $db->execute();
    }

    protected function setParams()
    {
        $db = JFactory::getDbo();

        $query = $db->getQuery(true);

        // Fields to update.
        $fields = array(
            $db->quoteName('params') . ' = ' . $db->quote('{"navigation_mode":"1","pagtesouro_theme":"tema-dark","columns":"2"}'),
        );

        // Conditions for which records should be updated.
        $conditions = array(
            $db->quoteName('name') . ' = ' . $db->quote('com_grupayer'),
        );

        $query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);

        $db->setQuery($query);

        $result = $db->execute();
    }

    public function install($parent)
    {
    }

    public function uninstall($parent)
    {
    }

    public function update($parent)
    {
    }

    public function preflight($type, $parent)
    {
    }

    function postflight($type, $parent)
    {
        if($type === 'install'){
            $this->setRules();
            $this->setParams();
        }
    }
}
