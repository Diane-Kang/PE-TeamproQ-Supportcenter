/*Definde a function for waiting target dependcy(callback)*/
var waitForTarget = function(target, callback) {
  if (typeof target === 'undefined') {
    setTimeout(function() {
      waitForTarget(target, callback);
    }, 100);
  } else {
    callback();
  }
};

/*Wrap the target code with waitingfunction, where your dependency is missing*/


function topFunction(){
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
}


///////////////////////////////////////////////////////////
// Sticky scroll button

const observer = new IntersectionObserver(entries => {
  console.log(entries)
})

window.onload = function(){
  observer.observe(document.getElementById("wie-lassen-sich-einheiten-teilen"))
}