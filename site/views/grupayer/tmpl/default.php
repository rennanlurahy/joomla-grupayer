<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

foreach ($this->inputs as $i => $row) {
    if ($this->inputs[$i]->mask === "currency") {
        JFactory::getDocument()->addScriptDeclaration('
            jQuery(document).ready(function(){
                jQuery("#jform_' . $row->name . '").on("input", function (event){ currencyMask(event, jQuery("#jform_' . $row->name . '"))})
            })
        ');
    } elseif ($row->mask === "fullDate") {
        JFactory::getDocument()->addScriptDeclaration('
            jQuery(document).ready(function(){
                jQuery("#jform_' . $row->name . '").on("input", function (event){ fullDateMask(event, jQuery("#jform_' . $row->name . '"))})
            })
        ');
    } elseif ($row->mask === "monthYearDate") {
        JFactory::getDocument()->addScriptDeclaration('
            jQuery(document).ready(function(){
                jQuery("#jform_' . $row->name . '").on("input", function (event){ monthYearMask(event, jQuery("#jform_' . $row->name . '"))})
            })
        ');
    } elseif ($row->mask === "cnpjCpf") {
        JFactory::getDocument()->addScriptDeclaration('
            jQuery(document).ready(function(){
                jQuery("#jform_' . $row->name . '").on("input", function (event){ cnpjCpfMask(event, jQuery("#jform_' . $row->name . '"))})
            })
        ');
    }
}
?>

<div id="j-main-container">
    <form action="<?php echo JRoute::_('index.php?option=com_grupayer'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
        <div class="form-vertical">
            <?php $a = 0; ?>
            <?php for ($k = 0; $k < ceil(count($this->inputs) / $this->params->columns); $k++) { ?>
                <div class="my-form-row">
                    <?php for ($i = 0; $i < $this->params->columns; $i++) { ?>
                        <?php if (isset($this->inputs[$a])) { ?>
                            <div class="input-wrapper"><?php echo $this->form->renderField($this->inputs[$a]->name); ?></div>
                        <?php } ?>
                        <?php $a++; ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <div class="my-form-submit-button-wrapper">
            <button id="pay" class="btn btn-primary validate" data-loading-text="
                    <svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' style='margin: auto; background: none; display: block; shape-rendering: auto;' width='16px' height='16px' viewBox='0 0 100 100' preserveAspectRatio='xMidYMid'>
                        <circle cx='50' cy='50' fill='none' stroke='#ffffff' stroke-width='10' r='35' stroke-dasharray='164.93361431346415 56.97787143782138'>
                            <animateTransform attributeName='transform' type='rotate' repeatCount='indefinite' dur='1s' values='0 50 50;360 50 50' keyTimes='0;1'></animateTransform>
                        </circle>
                    </svg>
                " type="button" onclick="Joomla.submitbutton('grupayer.pay', '<?php echo $this->params->pagtesouro_url; ?>')">
                <?php echo JText::_('COM_GRUPAYER_BUTTON_LABEL_PAY'); ?>
            </button>
        </div>
        <div id='pagtesouro' class="pagtesouromodal fade" tabindex="-1">
            <div class="pagtesouromodal-dialog">
                <div class="pagtesouromodal-body">
                </div>
            </div>
        </div>
        <input type="hidden" id="task" name="task" value="payment" />
        <input type="hidden" id="token" name="<?php echo JSession::getFormToken(); ?>" value="1" />
    </form>
</div>