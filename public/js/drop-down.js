function dropDown() {
    const dropDown = document.querySelector('.drop-down')
    dropDown.classList.toggle('active')

    const arrow = document.querySelector('.fa-angle-up')
    arrow.classList.toggle('arrow-animation');

}