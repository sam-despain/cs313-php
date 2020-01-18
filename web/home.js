var drop = document.getElementsByClassName("dropButton");
var i;

for (i = 0; i < drop.length; i++) {
  drop[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var contents = this.nextElementSibling;
    if (contents.style.maxHeight) {
      contents.style.maxHeight = null;
    } else {
      contents.style.maxHeight = contents.scrollHeight + "px";
    }
  });
}