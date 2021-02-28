Joomla.submitbutton = function (task, origin) {
    jQuery(".btn#pay").button("loading")
    
    if (task == '') {
        jQuery(".btn#pay").button('reset')
        return false;
    }
    else {
        var isValid = true;
        var action = task.split('.');
        if (action[1] != 'cancel' && action[1] != 'close') {
            var forms = jQuery('form.form-validate');
            for (var i = 0; i < forms.length; i++) {
                if (!document.formvalidator.isValid(forms[i])) {
                    isValid = false;
                    break;
                }
            }
        }
        if (isValid) {
            const inputs = jQuery("#adminForm .inputbox")

            let task = `task=${jQuery("#adminForm #task").val()}`
            let token = `${jQuery("#adminForm #token").attr("name")}=1`

            const values = {}
            for (let i = 0; i < inputs.length; i++) {
                const property = inputs[i].id.replace(/^jform\_/gim, "")
                if (inputs[i].className.indexOf("mask-currency") !== -1) {
                    values[property] = currencyTransform(inputs[i].value)
                    continue
                } else if (inputs[i].className.indexOf("mask-cnpjCpf") !== -1) {
                    values[property] = cnpjCpfTransform(inputs[i].value)
                    continue
                } else if (inputs[i].className.indexOf("mask-fullDate") !== -1) {
                    values[property] = fullDateTransform(inputs[i].value)
                    continue
                } else if (inputs[i].className.indexOf("mask-monthYearDate") !== -1) {
                    values[property] = monthYearDateTransform(inputs[i].value)
                    continue
                }

                values[property] = inputs[i].value
            }

            jQuery.ajax({
                type: "POST",
                url: `index.php?option=com_grupayer&${task}&${token}&format=json`,
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ content: values }),
                success: function (result, status, xhr) {
                    jQuery('#pagtesouro.pagtesouromodal .pagtesouromodal-dialog .pagtesouromodal-body').append(`
                        <iframe class="iframe-epag" src="${result.data}"></iframe>
                    `)

                    jQuery('#pagtesouro.pagtesouromodal .pagtesouromodal-dialog .pagtesouromodal-body').append(`
                        <script>
                            iFrameResize({
                                autoResize: true,
                                heightCalculationMethod: "documentElementOffset",
                            }, ".iframe-epag");
                        </script>
                    `)
                    
                    showPagTesouroModal('pagtesouro', jQuery(".btn#pay"), origin)
                },
                error: function (request) {
                    console.log(request)
                    let msgs = null

                    if (request.responseJSON) {
                        msgs = request.responseJSON.messages
                    } else if (request.status && request.statusText) {
                        msgs = { 'error': [`Status ${request.status} - ${request.statusText}`] }
                    } else {
                        msgs = { 'error': ['Algo inesperado aconteceu. Por favor, contate o administrador do sistema!'] }
                    }

                    Joomla.renderMessages(msgs);

                    jQuery(".btn#pay").button('reset')
                },
            });

            return true;
        }
        else {
            jQuery(".btn#pay").button('reset')
            return false;
        }
    }
}