document.addEventListener("DOMContentLoaded", function() {
    var btnAddPlaylist = document.getElementById("btnAddPlaylist");
    var playlistPopup = document.getElementById("playlistPopup");
    var btnSavePlaylist = document.getElementById("btnSavePlaylist");

    btnAddPlaylist.addEventListener("click", function() {
        playlistPopup.style.display = "block";
    });

    btnSavePlaylist.addEventListener("click", function() {
        var playlistName = document.getElementById("playlistName").value;
        alert("Playlist ajoutée : " + playlistName);
        playlistPopup.style.display = "none";
    });
});
