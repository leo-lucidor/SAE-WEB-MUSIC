<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Crée ton compte Spotiut'o</title>
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;700&family=Hind+Siliguri:wght@300;400;500;600&family=Lexend:wght@200;300;400;500;600;700;800;900&family=M+PLUS+Rounded+1c:wght@100;300;400;500;700&family=Montserrat:wght@400;700&family=Noto+Sans:ital,wght@0,100;0,300;0,400;0,600;1,500&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="topbar">
        <a href="" class="logo-container">
            <img src="./images/logo.png" alt="logo" class="logo">
            <strong class="title">SPOTIUT'O</strong>
        </a>
    </nav>
    <main class="main-container">
        <h1 class="text-center">Inscris-toi gratuitement</h1>
        <p class="subtitle">Déjà inscrit·e sur Spotiut'o ?<a href="">Connexion</a></p>
        <form action="index.php?action=accueil" method="POST" class="form">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre adresse e-mail">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">
                    <span id="toggle-password" onclick="togglePasswordVisibility()">
                        👁️
                    </span>
                </div>
                <div class="password-hint">8 caractères min.</div>
            </div> 
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
            </div>     
            <p>En cliquant sur "Inscription", tu acceptes les Conditions générales d'utilisation et la Politique de protection des données</p>
            <button type="submit">S'inscrire</button>
        </form>
    </main>
    <script src="./js/login.js"></script>
</body>