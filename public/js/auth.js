//AVOID ANIMATION RUNNING BEFORE PAGE TOTAL LOADING

document.body.classList.add('js-loading');

window.addEventListener("load", showPage);

function showPage() {
  document.body.classList.remove('js-loading');
}

//AVOID ANIMATION RUNNING WHEN RESIZING WINDOW

let resizeTimer;
window.addEventListener("resize", () => {
  document.body.classList.add("resize-animation-stopper");
});


//STOP RESUBMITTING
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

function setAdmin() {
  const icon = document.querySelector('.fa-user-shield')
  icon.classList.toggle('icon-active')

  const adminInput = document.getElementById("is_admin");

  if(adminInput.value == 0 ) {
    adminInput.value = 1;
  } else {
    adminInput.value = 0;
  }
}