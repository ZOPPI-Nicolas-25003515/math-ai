<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/res/image/logoMathAi.ico">
    <title><?= htmlspecialchars($title ?? 'MathIA') ?></title>
    <link rel="stylesheet" href= "/res/css/style.css">
</head>

<body>
<header>
    <nav>
        <a href="/">MathsAI</a>
        <?php $user = $_SESSION['email'] ?? null; ?>
        <?php if ($user === null) { ?>
            <a href="/login">Connexion</a>
            <a href="/register">Inscription</a>
        <?php } else { ?>
            <a href="/logout">Déconnexion</a>
        <?php } ?>
    </nav>
</header>

<main>

    <?= $data['content']?>

</main>

<footer class="footer">
    <ul>
        <li> <a href="/">Accueil</a></li>
        <li> <a href="/sitemap"> Plan du site</a></li>
        <li> <a href="/contact"> Nous contacter</a> </li>
        <li> <a href="/mentions"> Mentions légales </a></li>
    </ul>
</footer>
</body>
</html>