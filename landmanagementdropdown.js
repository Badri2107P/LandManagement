var idmodal = document.getElementById("findplotbyidModal");
var idbtn = document.getElementById("findplotbyid");
var idspan = document.getElementsByClassName("close")[0];
idbtn.onclick = function() {
    idmodal.style.display = "block";
}
idspan.onclick = function() {
    idmodal.style.display = "none";
}


window.onclick = function(event) {
    if (event.target == idmodal) {
        idmodal.style.display = "none";
    }
} 