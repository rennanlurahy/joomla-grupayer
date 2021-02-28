<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

?>
<div id="j-sidebar-container" class="span2">
    <?php echo JHtmlSidebar::render(); ?>
</div>
<div id="j-main-container" class="span10">
    <form action="<?php echo JRoute::_('index.php?option=com_grupayer&view=services'); ?>" method="post" id="adminForm" name="adminForm">
        <div class="row-fluid">
            <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
        </div>
        <?php if (empty($this->items)) : ?>
            <div class="alert alert-no-items">
                <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th width="1%"><?php echo JText::_('COM_GRUPAYER_NUM'); ?></th>
                        <th width="2%">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th width="87%">
                            <?php echo JHTML::_('grid.sort', 'COM_GRUPAYER_THEAD_DESCRIPTION', 'description', $this->sortDirection, $this->sortColumn); ?>
                        </th>
                        <th width="10%">
                            <?php echo JHTML::_('grid.sort', 'COM_GRUPAYER_THEAD_PUBLISHED', 'published', $this->sortDirection, $this->sortColumn); ?>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if (!empty($this->items)) : ?>
                        <?php foreach ($this->items as $i => $row) :
                            $link = JRoute::_('index.php?option=com_grupayer&task=service.edit&id=' . $row->id);
                        ?>
                            <tr>
                                <td>
                                    <?php echo $this->pagination->getRowOffset($i); ?>
                                </td>
                                <td>
                                    <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                                </td>
                                <td>
                                    <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_GRUPAYER_EDIT_NAME_ACTION'); ?>">
                                        <?php echo $row->description; ?>
                                    </a>
                                    <div class="small break-word">
                                        <?php echo JText::_('COM_GRUPAYER_FORM_LABEL_CODE'); ?>
                                        <?php echo $row->code; ?>
                                    </div>
                                </td>
                                <td align="center">
                                    <?php
                                    if ($this->canDo->get('core.edit.state')) {
                                        echo JHtml::_('service.published', $row->published, $i);
                                    } else {
                                        echo JHtml::_('service.published', $row->published, $i, false);
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>