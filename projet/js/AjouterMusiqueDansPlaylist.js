document.addEventListener("DOMContentLoaded", function() {
    let containers = document.querySelectorAll(".container-album-unique-artistecontainer-ajouter");

    containers.forEach(function(container) {
        let btnAddMusic = container.querySelector(".btn-ajouter-a-playlist");
        let playlistPopup = container.querySelector(".container-ajouter");

        btnAddMusic.addEventListener("click", function() {
            console.log("click");
            playlistPopup.style.display = "block";
        });
    });
});
