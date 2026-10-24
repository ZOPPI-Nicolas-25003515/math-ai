<?php

use App\Model\UserRepository;

$A_view = $A_view ?? [];
$error = $A_view['errors'] ?? [];
$userRepository = new UserRepository();
$subject = $userRepository->takeSubject();
?>

<h1>Ajout d'exercice</h1>

<?php
if(!empty($error)){?>
    <p style="color: red;"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
    <a href="/home">Retour</a>
    <form action="/addexercise" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label for="pdf_file"><b>Étape 1 : Choisiser l'exercice en PDF :</b></label><br>
                    <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>
                </p>
            </li>
            <li>
            <select name="subject" id="subject" required>
                <option value="">-- Choisissez un sujet --</option>

                <?php foreach ($subject as $subjec): ?>
                    <option value="<?= htmlspecialchars($subjec['id']) ?>">
                <?= htmlspecialchars($subjec['subject_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="type" id="type" required>
                <option value="">-- Choisissez le type d'exercice --</option>
                    <option value="reponse libre">reponse libre</option>
                    <option value="QCM a une reponse">QCM a une reponse</option>
                    <option value="QCM a choix multiple">QCM a choix multiple</option>
                </select>
             </li>
            <li>
            <p>
                <label for="dificulte-select">choisiser la dificulter:</label>

                <select name="dificulte" id="dificulte-select" required>
                    <option value="moyen">moyen</option>
                    <option value="facile">facile</option>
                    <option value="moyen">moyen</option>
                    <option value="dificile">dificile</option>
                </select>
            </p>
        </li>
        <button type="submit">Ajouter</button>
    </ul>
    </form>
</span>
