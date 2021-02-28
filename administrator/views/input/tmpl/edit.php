<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<div id="j-main-container">
    <form
        action="<?php echo JRoute::_('index.php?option=com_grupayer&layout=edit&id=' . (int) $this->item->id); ?>"
        method="post"
        name="adminForm"
        id="adminForm"
    >
        <input id="jform_title" type="hidden" name="grupayer-input-title"/>
        <div class="form-horizontal">
            <div class="row-fluid">
                <?php echo JHtml::_('bootstrap.startTabSet', 'inputSettings', array('active' => 'general')); ?>
                <?php echo JHtml::_('bootstrap.addTab', 'inputSettings', 'general', JText::_('COM_GRUPAYER_INPUT_TAB1_LABEL')); ?>
                    <div class="">
                        <?php echo $this->form->renderFieldset('input_config') ?>
                    </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php if ($this->canDo->get('core.admin')) { ?>
                <?php echo JHtml::_('bootstrap.addTab', 'inputSettings', 'permissions', JText::_('COM_GRUPAYER_FIELDSET_RULES')); ?>
                    <div class="">
                        <?php echo $this->form->renderFieldset('accesscontrol') ?>
                    </div>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
                <?php } ?>
                <?php echo JHtml::_('bootstrap.endTabSet'); ?>
            </div>
        </div>
        <input type="hidden" name="task" value="grupayer.edit" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>