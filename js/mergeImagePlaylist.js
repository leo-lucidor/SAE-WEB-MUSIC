 // Charger les quatre images
 var images = [];
 var loadedImages = 0;

 function loadImage(src, index) {
     var img = new Image();
     img.onload = function() {
         loadedImages++;
         if (loadedImages === 4) {
             mergeImages();
         }
     };
     img.src = src;
     images[index] = img;
 }

 // Charger les images
 loadImage('image1.jpg', 0);
 loadImage('image2.jpg', 1);
 loadImage('image3.jpg', 2);
 loadImage('image4.jpg', 3);

 function mergeImages() {
     // Créer un canvas temporaire pour fusionner les images
     var canvas = document.createElement('canvas');
     var ctx = canvas.getContext('2d');

     // Taille des images individuelles
     var imageWidth = images[0].width;
     var imageHeight = images[0].height;

     // Taille de l'image de sortie
     var outputWidth = imageWidth * 2;
     var outputHeight = imageHeight * 2;

     // Définir la taille du canvas
     canvas.width = outputWidth;
     canvas.height = outputHeight;

     // Fusionner les images sur le canvas
     for (var i = 0; i < 2; i++) {
         for (var j = 0; j < 2; j++) {
             ctx.drawImage(images[i * 2 + j], j * imageWidth, i * imageHeight, imageWidth, imageHeight);
         }
     }

     // Convertir le canvas en URL de données (data URL)
     var mergedImageUrl = canvas.toDataURL();

     // Afficher l'image fusionnée dans la balise <img>
     var mergedImageElement = document.getElementById('mergedImage');
     mergedImageElement.src = mergedImageUrl;
 }