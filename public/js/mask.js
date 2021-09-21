const Mask = {
    apply(input, func) {
        setTimeout(function() {
            input.value = Mask[func](input.value) //formatBRL(500)
        }, 1)
    },
    formatBRL(value) {
        
        value = value.replace(/\D/g,"")
    
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value/100)
    },
    convertBRL(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value)
    },
    convertBRLwithDecimals(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value/100)
    }
}