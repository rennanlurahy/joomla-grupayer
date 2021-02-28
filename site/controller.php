<?php

class GruPayerController extends JControllerForm
{
    public function payment()
    {
        JSession::checkToken('get') or jexit(JText::_('JINVALID_TOKEN'));

        $data = JFactory::getApplication()->input->json->get('content', array(), true);
        $model = $this->getModel('GruPayer');
        $model->create($data);
    }
}