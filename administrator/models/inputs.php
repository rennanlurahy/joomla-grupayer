<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class GruPayerModelInputs extends JModelList
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'description',
                'disabled',
                'required',
                'published'
            );
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select('*')
            ->from($db->quoteName('#__grupayer_form_config'));

        $search = $this->getState('filter.search');

        if (!empty($search)) {
            $like = $db->quote('%' . $search . '%');
            $query->where('description LIKE ' . $like);
        }

        // Filter by published state
        $disabled = $this->getState('filter.disabled');

        if (is_numeric($disabled)) {
            $query->where('disabled = ' . (int) $disabled);
        } elseif ($disabled === '') {
            $query->where('(disabled IN (0, 1))');
        }

        // Filter by published state
        $required = $this->getState('filter.required');

        if (is_numeric($required)) {
            $query->where('required = ' . (int) $required);
        } elseif ($required === '') {
            $query->where('(required IN (0, 1))');
        }

        // Filter by published state
        $published = $this->getState('filter.published');

        if (is_numeric($published)) {
            $query->where('published = ' . (int) $published);
        } elseif ($published === '') {
            $query->where('(published IN (0, 1))');
        }

        // Add the list ordering clause.
        $orderCol    = $this->state->get('list.ordering', 'description');
        $orderDirn     = $this->state->get('list.direction', 'asc');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }

    protected function populateState($ordering = null, $direction = null)
    {
        parent::populateState('description', 'DESC');
    }
}
