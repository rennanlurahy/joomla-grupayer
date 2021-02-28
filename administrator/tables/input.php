<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\Utilities\ArrayHelper;

class GruPayerTableInput extends JTable
{
    function __construct(&$db)
    {
        parent::__construct('#__grupayer_form_config', 'id', $db);
    }
    
    protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_grupayer.input.'.(int) $this->$k;
	}

    protected function _getAssetTitle()
	{
		return $this->description;
	}

    protected function _getAssetParentId(JTable $table = NULL, $id = NULL)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = JTable::getInstance('Asset');
		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// Find the parent-asset
		if (($this->catid)&& !empty($this->catid))
		{
			// The item has a category as asset-parent
			$assetParent->loadByName('com_grupayer.input.' . (int) $this->catid);
		}
		else
		{
			// The item has the component as asset-parent
			$assetParent->loadByName('com_grupayer');
		}

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId=$assetParent->id;
		}
		return $assetParentId;
	}

    public function disable($pks = null, $state = 1, $userId = 0)
    {
        $k = $this->_tbl_key;

        // Sanitize input.
        $pks    = ArrayHelper::toInteger($pks);
        $userId = (int) $userId;
        $state  = (int) $state;

        // If there are no primary keys set check to see if the instance key is set.
        if (empty($pks)) {
            if (!$this->$k) {
                $this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
                
                return false;
            }
        }

        // Get an instance of the table
        /** @var BannersTableBanner $table */
        $table = JTable::getInstance('Input', 'GruPayerTable');

        // For all keys
        foreach ($pks as $pk) {
            // Load the banner
            if (!$table->load($pk)) {
                $this->setError($table->getError());
            }
            $table->disabled = $state;

            // Check the row
            $table->check();

            // Store the row
            if (!$table->store()) {
                $this->setError($table->getError());
            }
        }

        return count($this->getErrors()) == 0;
    }

    public function require($pks = null, $state = 1, $userId = 0)
    {
        $k = $this->_tbl_key;

        // Sanitize input.
        $pks    = ArrayHelper::toInteger($pks);
        $userId = (int) $userId;
        $state  = (int) $state;

        // If there are no primary keys set check to see if the instance key is set.
        if (empty($pks)) {
            if (!$this->$k) {
                $this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
                
                return false;
            }
        }

        // Get an instance of the table
        /** @var BannersTableBanner $table */
        $table = JTable::getInstance('Input', 'GruPayerTable');

        // For all keys
        foreach ($pks as $pk) {
            // Load the banner
            if (!$table->load($pk)) {
                $this->setError($table->getError());
            }

            $table->required = $state;

            // Check the row
            $table->check();

            // Store the row
            if (!$table->store()) {
                $this->setError($table->getError());
            }
        }

        return count($this->getErrors()) == 0;
    }

    public function publish($pks = null, $state = 1, $userId = 0)
    {
        $k = $this->_tbl_key;

        // Sanitize input.
        $pks    = ArrayHelper::toInteger($pks);
        $userId = (int) $userId;
        $state  = (int) $state;

        // If there are no primary keys set check to see if the instance key is set.
        if (empty($pks)) {
            if (!$this->$k) {
                $this->setError(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
                
                return false;
            }
        }

        // Get an instance of the table
        /** @var BannersTableBanner $table */
        $table = JTable::getInstance('Input', 'GruPayerTable');

        // For all keys
        foreach ($pks as $pk) {
            // Load the banner
            if (!$table->load($pk)) {
                $this->setError($table->getError());
            }

            $table->published = $state;

            // Check the row
            $table->check();

            // Store the row
            if (!$table->store()) {
                $this->setError($table->getError());
            }
        }

        return count($this->getErrors()) == 0;
    }
}
