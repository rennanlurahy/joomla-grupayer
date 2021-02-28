function hidePagTesouroModal(modal, buttonInstance) {
    modal.removeClass('show')
    jQuery('body').removeClass('pagtesouromodal-open')
    if (buttonInstance) buttonInstance.button('reset')
}

function showPagTesouroModal(modal, buttonInstance, origin) {
    jQuery(`#${modal}`).addClass('show')
    jQuery('body').addClass('pagtesouromodal-open')

    jQuery(document).ready(function () {
        jQuery('.pagtesouromodal').on('click', function () {
            jQuery(`#${modal} .pagtesouromodal-dialog .pagtesouromodal-body`).empty()
            hidePagTesouroModal(jQuery(`#${modal}`), buttonInstance)
        })
        window.addEventListener('message', function (event) {
            if (event.origin !== origin) return
            if (event.data === "EPAG_FIM") {
                jQuery(`#${modal} .pagtesouromodal-dialog .pagtesouromodal-body`).empty()
                hidePagTesouroModal(jQuery(`#${modal}`), buttonInstance)
            }
        }, false)
    })
}
