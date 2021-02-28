function cnpjCpfTransform(value){
    const onlyNumbers = value.replace(/[^\d]/gim, "")
    return onlyNumbers
}

function currencyTransform(value){
    const noSpaces = value.replace(/\s/gim, "")
    const noSymbol = noSpaces.replace(/R\$/gim, "")
    const quoteConvert =  noSymbol.replace(/,/gim, ".")
    return parseFloat(quoteConvert)
}

function fullDateTransform(value){
    const onlyNumbers = value.replace(/[^\d]/gim, "")
    return onlyNumbers
}

function monthYearDateTransform(value){
    const onlyNumbers = value.replace(/[^\d]/gim, "")
    return onlyNumbers
}