const cards = document.querySelectorAll('.card')

for(let card of cards) {
    card.addEventListener("click", function(){
        const id = card.getAttribute("id")
        if(window.location.pathname == "/products") {
            window.location.href = `products/${id}`
        } else {
            window.location.href = `pc-builds/${id}`
        }
    })
}

const products = document.querySelectorAll('.pcbuild')

for(let product of products) {
    product.addEventListener("click", function(){
        const id = product.getAttribute("id")
        window.location.pathname = `/products/${id}`
    })
}