function hideError(e)
{
  e.style.display = "none";
}

// FADE OUT ANIMATION

setTimeout(function(){ 
  let msgElements = document.getElementsByClassName("fade-in");
  for(var i = 0; i < msgElements.length; i++)
  {
    msgElements[i].className += " fade-out";
  }
  removeElements(msgElements);
}, 3500);

function removeElements(msgElements) {
  setTimeout(function(){ 
    msgElements[0].parentNode.innerHTML = "";
  }, 2000);
}