var dragItem = document.querySelector("#item");
var container = document.querySelector("#container");

var active = false;
var currentX;
var currentY;
var initialX;
var initialY;
var itemClick;
var xOffset = 0;
var yOffset = 0;

if (container) {
  if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("click", toggleSwitch, false);
  } else {
    container.addEventListener("touchstart", dragStart, false);
    container.addEventListener("touchend", dragEnd, false);
    container.addEventListener("touchmove", drag, false);
  
    container.addEventListener("mousedown", dragStart, false);
    if (dragItem) {
      dragItem.addEventListener("mousedown", itemDragStart, false);
    }
  
    container.addEventListener("mousemove", drag, false);
  
    container.addEventListener("mouseup", dragEnd, false);
    container.addEventListener("click", toggleSwitch, false);
  }

}

function dragStart(e) {
  var elm = $(this);
  var xPos = e.pageX - elm.offset().left;
  
  if (e.type === "touchstart") {
    var xPosMobile = e.touches[0].pageX - elm.offset().left;
    initialX = xPosMobile;
  } else {
    initialX = xPos; 
  }
  
  dragItem.style.transition = "all .2s cubic-bezier(0.04, 0.46, 0.36, 0.99)";

  if (e.target === dragItem) {
    active = true;
  }
}

function itemDragStart(e) {
  var elm = $(this);
  var xPos = e.pageX - elm.offset().left;
  
  itemClick = xPos;
}

function toggleSwitch(e) {
  if (initialX > 100) {
    currentX = 0;
  } else {
    currentX = 200;
  }
}

function dragEnd(e) {
  initialX = currentX;

  active = false;
    
  if (initialX > 100) {
    currentX = 200;
    dragItem.style.transition = "all .2s cubic-bezier(0.04, 0.46, 0.36, 0.99)";
    container.classList.add('select-right');
    container.classList.remove('select-left');
  } else {
    currentX = 0;
    dragItem.style.transition = "all .2s cubic-bezier(0.04, 0.46, 0.36, 0.99)";
    container.classList.remove('select-right');
    container.classList.add('select-left');
  }
  
  setTranslate(currentX, dragItem);
}

function drag(e) {
  var elm = $(this);
  var xPos = e.pageX - elm.offset().left;
  if (!(xPos > 400 || xPos < 0)) {
    if (active) {
      e.preventDefault();

      if (e.type === "touchmove") {
        var xPosMobile = e.touches[0].pageX - elm.offset().left;
        currentX = xPosMobile - initialX; 
        if (initialX > 200) {
          currentX = xPosMobile - itemClick;
        }
        if (currentX > 200) {
          currentX = 200;
          active = false;
          container.classList.add('select-right');
          container.classList.remove('select-left');
        } else if (currentX < 0) {
          currentX = 0;
          active = false;
          container.classList.remove('select-right');
          container.classList.add('select-left');
        }
      } else {
        currentX = xPos - initialX;
        if (initialX > 200) {
          currentX = xPos - itemClick;
        }
        if (currentX > 200) {
          currentX = 200;
          active = false;
          container.classList.add('select-right');
          container.classList.remove('select-left');
        } else if (currentX < 0) {
          currentX = 0;
          active = false;
          container.classList.remove('select-right');
          container.classList.add('select-left');
        }
      }

      dragItem.style.transition = "all .05s cubic-bezier(0.04, 0.46, 0.36, 0.99)";

      xOffset = currentX;

      setTranslate(currentX, dragItem);
    }
  } else {
    active = false;
    
    if (initialX > 200) {
      dragItem.style.transform = "translate3d(200px, 0px, 0)";
    } else {
      dragItem.style.transform = "translate3d(0, 0px, 0)"; 
    }
  }
}

function setTranslate(xPos, el) {
  el.style.transform = "translate3d(" + xPos + "px, 0px, 0)";
}
