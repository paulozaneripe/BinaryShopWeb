function updatePrices(e) {
    let inputName = e.name;
    
    if(inputName != "ramQty" && inputName != "storageQty") {
        let price = e.options[e.selectedIndex].dataset.price
        document.getElementById(`${inputName}-price`).value = Mask.convertBRL(price)
    
        let image = e.options[e.selectedIndex].dataset.image
        document.getElementById(`${inputName}-image`).src = image
    }

    const ramQuantity = document.getElementById('ram-quantity')
    const storageQuantity = document.getElementById('storage-quantity')
    const ramPrice = document.getElementById('ram-price')
    const storagePrice = document.getElementById('storage-price')

    let finalValue = 0

    var selectInputs = document.querySelectorAll(".input-field > select");
    for(i = 0; i < selectInputs.length; i++) {
        if(selectInputs[i].options[selectInputs[i].selectedIndex].dataset.type == "ram") {
            if(ramQuantity.disabled == true || !ramQuantity.value) {
                ramQuantity.disabled = false
                ramQuantity.value = 1
            }

            const ramSelected = document.getElementById('ram')
            let ramDataPrice = ramSelected.options[ramSelected.selectedIndex].dataset.price
            ramPrice.value = Mask.convertBRL(ramDataPrice * parseInt(ramQuantity.value))

            finalValue +=  parseFloat(selectInputs[i].options[selectInputs[i].selectedIndex].dataset.price) * parseInt(ramQuantity.value)

        } else if (selectInputs[i].options[selectInputs[i].selectedIndex].dataset.type == "storage") {
            if(storageQuantity.disabled == true || !storageQuantity.value ) {
                storageQuantity.disabled = false
                storageQuantity.value = 1
            }

            const storageSelected = document.getElementById('storage')
            let storageDataPrice = storageSelected.options[storageSelected.selectedIndex].dataset.price
            storagePrice.value = Mask.convertBRL(storageDataPrice * parseInt(storageQuantity.value))
            finalValue +=  parseFloat(selectInputs[i].options[selectInputs[i].selectedIndex].dataset.price) * parseInt(storageQuantity.value)
        } else if(selectInputs[i].options[selectInputs[i].selectedIndex].dataset.price != undefined){
            finalValue +=  parseFloat(selectInputs[i].options[selectInputs[i].selectedIndex].dataset.price)
        }
    }


    document.getElementById('total-price').value = Mask.convertBRL(finalValue)
}

function cleanFields() {
    document.getElementById("build").reset();

    const host = location.protocol + '//' + location.host

    document.getElementById('motherboard-image').src = 
    `${host}/img/motherboard.svg`  
    document.getElementById('cpu-image').src = 
    `${host}/img/cpu.svg`   
    document.getElementById('gpu-image').src = 
    `${host}/img/gpu.svg`    
    document.getElementById('ram-image').src = 
    `${host}/img/ram.svg`    
    document.getElementById('storage-image').src = 
    `${host}/img/storage.svg`    
    document.getElementById('powersuply-image').src = 
    `${host}/img/powersuply.svg`    
    document.getElementById('case-image').src = 
    `${host}/img/case.svg`  

    scroll(0,80)
}