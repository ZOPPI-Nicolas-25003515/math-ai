<?php

use App\Model\UserRepository;

$A_view = $A_view ?? [];
$error = $A_view['errors'] ?? [];
$userRepository = new UserRepository();
$highSchools = $userRepository->takeHighSchool();
$rank = $userRepository->takeRank();
$education = $userRepository->takeEducation();
$speciality = $userRepository->takeSpeciality();
?>

<h1>Ajout de cours</h1>

<?php
if(!empty($error)){?>
    <p style="color: red;"><?=htmlspecialchars($error[0])?></p><?php
}
?>

<span>
    <a href="/home">Retour</a>
    <form action="/addclassroom" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label for="csv_file"><b>Votre fichier .csv dois avoir un colone nomer NOM contenant le nom des eleves et une autre PRENOM contenant le prenom des eleves</b></label><br>
                </p>
            </li>
            <li>
                <p>
                    <label for="csv_file"><b>Choisisser le fichier csv:</b></label><br>
                    <input type="file" name="csv_file" id="csv_file" accept=".csv, text/csv" required>
                </p>
            </li>
            <li>
                <p>
                    <label for="titre_cours"><b>Nom de la class:</b></label><br>
                    <input type="text" name="titre_cours" >
                </p>
            </li>
            <li>
            <select name="subject" id="subject" required>
                <option value="">-- Choisissez le lycée --</option>

                <?php foreach ($highSchools as $highSchool): ?>
                    <option value="<?= htmlspecialchars($highSchool['id']) ?>">
                <?= htmlspecialchars($highSchool['high_school_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="subject" id="subject" required>
                <option value="">-- Choisissez le niveau --</option>

                <?php foreach ($rank as $ranks): ?>
                    <option value="<?= htmlspecialchars($ranks['id']) ?>">
                <?= htmlspecialchars($ranks['rank_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="subject" id="subject" required>
                <option value="">-- Choisissez le parcours --</option>

                <?php foreach ($education as $educations): ?>
                    <option value="<?= htmlspecialchars($educations['id']) ?>">
                <?= htmlspecialchars($educations['education_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="subject" id="subject" required>
                <option value="">-- Choisissez la specialiter --</option>

                <?php foreach ($speciality as $specialitys): ?>
                    <option value="<?= htmlspecialchars($specialitys['id']) ?>">
                <?= htmlspecialchars($specialitys['speciality_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
        <button type="submit" name="submit_import">Finaliser et Importer</button>
    </ul>
    </form>
</span>