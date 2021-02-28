jQuery(function () {
    document.formvalidator.setHandler('currency', function (value, input) {
        const regex = /(^R\$\s*\d{0,3}(\.\d{3})*,\d{2}$)|(^\d{0,3}(\.\d{3})*,\d{2}$)/;
        const onlyNumbers = value.replace(/[^\d]/gim, "")

        if (!input.context.required && (parseFloat(onlyNumbers) === 0 || !parseFloat(onlyNumbers) || onlyNumbers === "")) return true
        if (input.context.required && (parseFloat(onlyNumbers) === 0 || !parseFloat(onlyNumbers) || onlyNumbers === "")) return false

        if (!regex.test(value)) return false;

        return true
    });

    document.formvalidator.setHandler('cnpjCpf', function (value, input) {
        const regex1 = /(\d)\1{10}/
        const regex2 = /^(\d{3}\.\d{3}\.\d{3}\-\d{2})|(\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2})$/
        const onlyNumbers = value.replace(/[^\d]/gim, "")

        if (!input.context.required && onlyNumbers === "") return true
        if (input.context.required && onlyNumbers === "") return false

        if (regex1.test(value)) return false

        if (!regex2.test(value)) return false

        if (onlyNumbers.length <= 11) {
            var sum;
            var residual;
            sum = 0;

            for (i = 1; i <= 9; i++) sum = sum + parseInt(onlyNumbers.substring(i - 1, i)) * (11 - i);
            residual = (sum * 10) % 11;

            if ((residual == 10) || (residual == 11)) residual = 0;
            if (residual != parseInt(onlyNumbers.substring(9, 10))) return false;

            sum = 0;
            for (i = 1; i <= 10; i++) sum = sum + parseInt(onlyNumbers.substring(i - 1, i)) * (12 - i);
            residual = (sum * 10) % 11;

            if ((residual == 10) || (residual == 11)) residual = 0;
            if (residual != parseInt(onlyNumbers.substring(10, 11))) return false;
            return true;

        } else if (onlyNumbers.length > 11) {
            let size = onlyNumbers.length - 2
            let numbers = onlyNumbers.substring(0, size)
            const digits = onlyNumbers.substring(size);
            let sum = 0;
            let pos = size - 7;

            for (i = size; i >= 1; i--) {
                sum += numbers.charAt(size - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }

            resultado = sum % 11 < 2 ? 0 : 11 - sum % 11;

            if (resultado != digits.charAt(0)) return false;

            size = size + 1;
            numbers = onlyNumbers.substring(0, size);
            sum = 0;
            pos = size - 7;

            for (i = size; i >= 1; i--) {
                sum += numbers.charAt(size - i) * pos--;
                if (pos < 2)
                    pos = 9;
            }

            resultado = sum % 11 < 2 ? 0 : 11 - sum % 11;

            if (resultado != digits.charAt(1)) return false;

        }

        return true
    });

    document.formvalidator.setHandler('fullDate', function (value, input) {
        const regex = /^\d{2}\/\d{2}\/\d{4}$/
        const onlyNumbers = value.replace(/[^\d]/gim, "")

        if (!input.context.required && onlyNumbers === "") return true
        if (input.context.required && onlyNumbers === "") return false

        if (!regex.test(value)) return false

        const day = parseInt(onlyNumbers.substr(0, 2))
        const month = parseInt(onlyNumbers.substr(2, 2))
        const year = parseInt(onlyNumbers.substr(4, 4))

        if (day > 28 && month === 2 && year !== 0) {
            return false
        } else if (day > 29 && month === 2 && year === 0) {
            return false
        } else if (day > 30 && [4, 6, 9, 11].includes(month)) {
            return false
        } else if (day > 31) {
            return false
        } else if (month > 12) {
            return false
        } else if (new Date() > new Date(year, month - 1, day, 23, 59, 59, 99)) {
            return false
        }

        return true
    });

    document.formvalidator.setHandler('monthYearDate', function (value, input) {
        const regex = /^\d{2}\/\d{4}$/
        const onlyNumbers = value.replace(/[^\d]/gim, "")

        if (!input.context.required && onlyNumbers === "") return true
        if (input.context.required && onlyNumbers === "") return false

        if (!regex.test(value)) return false

        const month = parseInt(onlyNumbers.substr(0, 2))
        const year = parseInt(onlyNumbers.substr(2, 4))

        if (month > 12) return false

        return true
    });

})
