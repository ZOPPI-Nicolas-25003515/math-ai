<?php

use App\Model\UserRepository;

$A_view = $A_view ?? [];
$error = $A_view['errors'];
$userRepository = new UserRepository();
$subject = $userRepository->takeSubject();
?>

<h1>Ajout de cours</h1>

<?php
if(!empty($error)){?>
    <p style="color: red;"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
    <a href="/analyseia">Retour</a>
    <form action="/addclass" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label for="pdf_file"><b>Étape 1 : Choisir le cours en PDF :</b></label><br>
                    <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" required>
                </p>
            </li>
            <li>
                <p>
                    <label for="titre_cours"><b>Étape 2 : Titre du cours :</b></label><br>
                    <input type="text" name="titre_cours" >
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
        <button type="submit" name="submit_import">Finaliser et Importer</button>
    </ul>
    </form>
</span>

