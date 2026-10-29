<?php
$class = $A_view['class'] ?? [];
$pdfPath = '/resources/Class/' . htmlspecialchars($class['path_name']);
?>

<h1><?= htmlspecialchars($class['title']) ?></h1>
<a href="/analyseia">Retour à la liste</a>

<div style="margin-top: 20px;">
    <iframe src="/downloadclass?id=<?= $class['id']?>" width="100%" height="700px" style="border: 1px solid #ccc;">
        <p>Votre navigateur ne peut pas afficher les PDF directement.
            Vous pouvez <a href="/downloadclass?id=<?= $class['id'] ?>">le télécharger ici</a>.
        </p>
    </iframe>
</div>
