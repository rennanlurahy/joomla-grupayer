<?php

defined('_JEXEC') or die('Restricted access');

class GruPayerModelGruPayer extends JModelAdmin
{
    public function getInputs()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select('*')
            ->from($db->quoteName('#__grupayer_form_config'))
            ->where($db->quoteName('published') . '=' . $db->quote('1'));

        $db->setQuery($query);
        $inputs = $db->loadObjectList();

        return $inputs;
    }

    public function getParams()
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('params'))
            ->from($db->quoteName('#__extensions'))
            ->where($db->quoteName('name') . 'LIKE' . $db->quote('com_grupayer'));

        $db->setQuery($query);
        $params = $db->loadResult();

        return json_decode($params);
    }

    public function getForm($data = array(), $loadData = true)
    {
        $inputs = $this->getInputs();
        $form = $this->loadForm('com_grupayer.grupayer', 'grupayer', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form)) {
            $errors = $this->getErrors();
            throw new Exception(implode("\n", $errors), 500);
        }

        foreach ($inputs as $i => $input) {
            $form->setField(new SimpleXMLElement('
                    <field
                        id = "' . $input->name . '"
                        name = "' . $input->name . '"
                        type = "' . $input->type . '"
                        label = "' . $input->description . '"
                        required = "' . $input->required . '"
                        disabled = "' . $input->disabled . '"
                        validate = "' . $input->validator . '"
                        class = "inputbox validate-' . $input->validator . ' mask-' . $input->mask . '"
                    />
                '), '', true, 'grupayer');
        }

        return $form;
    }

    public function create($data)
    {
        $form = $this->getForm();
        $app = JFactory::getApplication();

        if (!$data) {
            $app->enqueueMessage(JText::_('COM_GRUPAYER_CREATE_TASK_NO_VALUES'));

            http_response_code(400);
            echo new JResponseJson($data, JText::_('COM_GRUPAYER_CREATE_TASK_ERROR'), true);
            return false;
        }

        $validData = $this->validate($form, $data);

        if (!$validData) {
            http_response_code(400);
            echo new JResponseJson($data, JText::_('COM_GRUPAYER_CREATE_TASK_ERROR'), true);
            return false;
        }

        $params = $this->getParams();
        $pagtesouro_request = array_merge($data, array(
            'urlRetorno' => $params->return_url,
            'modoNavegacao' => (int) $params->navigation_mode,
            'urlNotificacao' => $params->notification_url,
        ));

        $opts = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => [
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $params->pagtesouro_token,
                ],
                "ignore_errors" => true,
                'content' => json_encode($pagtesouro_request)
            )
        );

        $context = stream_context_create($opts);

        $pagtesouro = json_decode(file_get_contents($params->pagtesouro_url."/api/gru/solicitacao-pagamento", false, $context));
        header($http_response_header[0]);

        if (http_response_code() >= 400) {
            foreach ($pagtesouro as $e => $error) {
                $app->enqueueMessage('Pag Tesouro: '.$error->descricao);
            }
            echo new JResponseJson($validData, JText::_('COM_GRUPAYER_CREATE_PAGTESOURO_ERROR').". ".JText::_('COM_GRUPAYER_CREATE_TASK_ERROR'), true);
        } else {
            $pagtesouro->proximaUrl .= "&tema=" . $params->pagtesouro_theme."&btnConcluir=true";
            echo new JResponseJson($pagtesouro->proximaUrl, JText::_('COM_GRUPAYER_CREATE_TASK_SUCCESS'), false);
        }

        return true;
    }
}
