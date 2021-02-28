function currencyMask(event, input) {
    const value = event.target.value
    const onlyNumbers = value.replace(/([^\d])+/gim, "")

    if (onlyNumbers.length === 1) {
        let newValue = `00${onlyNumbers}`
        return input.val(`R$ ${newValue.replace(/(\d)(\d{2})/g, "$1,$2")}`)
    } else if (onlyNumbers.length === 2) {
        let newValue = `0${onlyNumbers}`
        return input.val(`R$ ${newValue.replace(/(\d)(\d{2})/g, "$1,$2")}`)
    } else {
        const int = onlyNumbers.slice(0, -2).replace(/^0/gim, "")
        let newInt = ""
        int.split("").reverse().forEach((current, index, arr) => {
            if (index % 3 === 0 && index !== 0) {
                newInt = current + "." + newInt
            } else {
                newInt = current + newInt
            }
        })

        const decimal = onlyNumbers.substr(-2)
        return input.val(`R$ ${newInt},${decimal}`)
    }
}

function cpfMask(event, input) {
    let selectionStart = event.target.selectionStart
    let value = event.target.value

    if (value.length === 15 && value[selectionStart] === '_' && [3, 7, 11].includes(selectionStart)) {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
        selectionStart++
    } else if (value.length === 15 && value[selectionStart] === '_') {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
    } else if (value.length === 13 && [3, 7].includes(selectionStart)) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_.')
        value = value.join('')
        selectionStart--
    } else if (value.length === 13 && selectionStart === 11) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_-')
        value = value.join('')
        selectionStart--
    } else if (value.length === 13 && selectionStart === 11) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_-')
        value = value.join('')
        selectionStart--
    } else if (value.length === 13) {
        value = value.split('')
        value.splice(selectionStart, 0, '_')
        value = value.join('')
    } else {
        const onlyNumbers = value.replace(/([^\d])+/gim, "").substr(0, 14)
        let newValue = onlyNumbers

        for (i = 0; i < 11 - onlyNumbers.length; i++) {
            newValue += "_"
        }

        value = newValue.replace(/(\w{3})(\w{3})(\w{3})(\w{2})/g, "$1.$2.$3-$4")
    }

    input.val(value)

    event.target.setSelectionRange(selectionStart, selectionStart)

    return value
}

function cnpjMask(event, input) {
    let selectionStart = event.target.selectionStart
    let value = event.target.value

    if (value.length === 19 && value[selectionStart] === '_' && [2, 6, 10, 15].includes(selectionStart)) {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
        selectionStart++
    } else if (value.length === 19 && value[selectionStart] === '_') {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
    } else if (value.length === 17 && [2, 6, 10, 15].includes(selectionStart)) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_.')
        value = value.join('')
        selectionStart--
    } else if (value.length === 17 && selectionStart === 10) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_/')
        value = value.join('')
        selectionStart--
    } else if (value.length === 17 && selectionStart === 15) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_-')
        value = value.join('')
        selectionStart--
    } else if (value.length === 13) {
        value = value.split('')
        value.splice(selectionStart, 0, '_')
        value = value.join('')
    } else {
        const onlyNumbers = value.replace(/([^\d])+/gim, "").substr(0, 14)
        let newValue = onlyNumbers

        for (i = 0; i < 14 - onlyNumbers.length; i++) {
            newValue += "_"
        }

        value = newValue.replace(/(\w{2})(\w{3})(\w{3})(\w{4})(\w{2})/g, "$1.$2.$3/$4-$5")
    }

    input.val(value)

    event.target.setSelectionRange(selectionStart, selectionStart)

    return value
}

function cnpjCpfMask(event, input) {
    let value = event.target.value
    const onlyNumbers = value.replace(/([^\d])+/gim, "").substr(0, 14)

    if (onlyNumbers.length === 12) {
        value = cnpjMask(event, input)
    } else if (onlyNumbers.length <= 11) {
        value = cpfMask(event, input)
    } else {
        value = cnpjMask(event, input)
    }

    return value
}

function fullDateMask(event, input) {
    let selectionStart = event.target.selectionStart
    let value = event.target.value

    if (value.length === 11 && value[selectionStart] === '_' && [2, 5].includes(selectionStart)) {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
        selectionStart++
    } else if (value.length === 11 && value[selectionStart] === '_') {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
    } else if (value.length === 9 && [2, 5].includes(selectionStart)) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_/')
        value = value.join('')
        selectionStart--
    } else if (value.length === 9) {
        value = value.split('')
        value.splice(selectionStart, 0, '_')
        value = value.join('')
    } else {

        const onlyNumbers = value.replace(/([^\d])+/gim, "").substr(0, 8)
        let newValue = onlyNumbers

        for (i = 0; i < 8 - onlyNumbers.length; i++) {
            newValue += "_"
        }

        value = newValue.replace(/(\w{2})(\w{2})(\w{4})/g, "$1/$2/$3")
    }

    input.val(value)

    event.target.setSelectionRange(selectionStart, selectionStart)

    return value
}

function monthYearMask(event, input) {
    let selectionStart = event.target.selectionStart
    let value = event.target.value

    if (value.length === 8 && value[selectionStart] === '_' && selectionStart === 2) {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
        selectionStart++
    } else if (value.length === 8 && value[selectionStart] === '_') {
        value = value.split('').filter((d, i) => i !== selectionStart).join('')
    } else if (value.length === 6 && selectionStart === 2) {
        value = value.split('')
        value.splice(selectionStart - 1, 1, '_/')
        value = value.join('')
        selectionStart--
    } else if (value.length === 6) {
        value = value.split('')
        value.splice(selectionStart, 0, '_')
        value = value.join('')
    } else if (value.length >= 8) {
        value = value.substr(0, 7)
    } else {
        const onlyNumbers = value.replace(/([^\d])+/gim, "")
        let newValue = onlyNumbers

        for (i = 0; i < 6 - onlyNumbers.length; i++) {
            newValue += "_"
        }

        value = newValue.replace(/(\w{2})(\w{4})/g, "$1/$2")
    }

    input.val(value)

    event.target.setSelectionRange(selectionStart, selectionStart)

    return value
}

function setCursor(event, end = false) {
    const value = event.target.value
    const firstUnderscore = value.indexOf('_')
    const selectionStart = event.target.selectionStart

    if (isNaN(value[selectionStart - 1]) && end === false){
        event.target.setSelectionRange(firstUnderscore, firstUnderscore)
    } else if(end === true){
        event.target.setSelectionRange(-1,-1)
    }
}

jQuery(document).ready(function (event) {
    const cnpjCpfInput = jQuery("#adminForm .mask-cnpjCpf")
    const fullDateInput = jQuery("#adminForm .mask-fullDate")
    const monthYearDateInput = jQuery("#adminForm .mask-monthYearDate")
    const currencyInput = jQuery("#adminForm .mask-currency")

    cnpjCpfInput.on("click", function (event) { setCursor(event) })
    fullDateInput.on("click", function (event) { setCursor(event) })
    monthYearDateInput.on("click", function (event) { setCursor(event) })
    currencyInput.on("click", function (event) { setCursor(event, true) })

    cnpjCpfInput.val("___.___.___-__")
    fullDateInput.val("__/__/____")
    monthYearDateInput.val("__/____")
    currencyInput.val("R$ 0,00")
})