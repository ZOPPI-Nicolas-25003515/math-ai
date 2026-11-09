<?php

use App\View\{Alert,Button,Form,Input,Layout,Label,Link,Hypertext,Paragraph,Title,Container,Select,Option};
use App\Model\UserRepository;

$A_view = $A_view ?? [];
$errors = $A_view['errors'] ?? [];
$userRepository = new UserRepository();
$highSchools = $userRepository->takeHighSchool();
$rank = $userRepository->takeRank();
$education = $userRepository->takeEducation();
$speciality = $userRepository->takeSpeciality();
$option1 = [];
$option2 = [];
$option3 = [];
$option4 = [];

foreach ($highSchools as $highSchool) {
    $option1= new Option(htmlspecialchars($highSchool['id']),[htmlspecialchars($highSchool['high_school_name'])] );
}
foreach ($rank as $ranks) {
    $option2 = new Option(htmlspecialchars($ranks['id']),[htmlspecialchars($ranks['rank_name'])] );
}
foreach ($education as $educations) {
    $option3 = new Option(htmlspecialchars($educations['id']),[htmlspecialchars($educations['education_name'])] );
}
foreach ($speciality as $specialities) {
    $option4 = new Option(htmlspecialchars($specialities['id']),[htmlspecialchars($specialities['speciality_name'])] );
}

echo new Layout('Ajout de class',isset($loggedUser),[
                new Title (1,['Ajout de class']),
                new Paragraph(
                        [new Alert ($errors)]),
                new Container('span',
                        [new Hypertext('/home',['Retour']),new Form("/addclass" ,"POST" ,
                                [new Container('ul',
                                        [new Container('li',
                                                [new Paragraph(
                                                        [new Label('regle', 'regle', [new Container('b',['Votre fichier .csv dois avoir un colone nomer NOM contenant le nom des eleves et une autre PRENOM contenant le prenom des eleves'])
                                                        ])]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Label('csv_file', 'csv_file', [new Container('b',['Choisisser le fichier csv:'])
                                                        ]), new Input('file','csv_file','csv_file','accept=".csv, text/csv" required')

                                                        ]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Label('titre_class', 'titre_class', [new Container('b',['Nom de la class:'])
                                                        ]), new Input('text','titre_class','titre_class','required')

                                                        ]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Select('highschool','highschool',[new Option('',['-- Choisissez le lycée --']),$option1])]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Select('level','level',[new Option('',['-- Choisissez le niveau --']),$option2])]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Select('education','education',[new Option('',['-- Choisissez le parcours --']),$option3])]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Select('speciality','speciality',[new Option('',['-- Choisissez la specialiter --']),$option4])]
                                                )]
                                        ),new Button('submit','',['Finaliser et Importer'])]
                                )]
                        )],"multipart/form-data")
            ,]
);
/*


<h1>Ajout de class</h1>

<span>
    <a href="/home">Retour</a>
    <form action="/addclassroom" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label for="regle"><b>Votre fichier .csv dois avoir un colone nomer NOM contenant le nom des eleves et une autre PRENOM contenant le prenom des eleves</b></label><br>
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
                    <label for="titre_class"><b>Nom de la class:</b></label><br>
                    <input type="text" name="titre_class" >
                </p>
            </li>
            <li>
            <select name="highschool" id="highschool" required>
                <option value="">-- Choisissez le lycée --</option>

                <?php foreach ($highSchools as $highSchool): ?>
                    <option value="<?= htmlspecialchars($highSchool['id']) ?>">
                <?= htmlspecialchars($highSchool['high_school_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="level" id="level" required>
                <option value="">-- Choisissez le niveau --</option>

                <?php foreach ($rank as $ranks): ?>
                    <option value="<?= htmlspecialchars($ranks['id']) ?>">
                <?= htmlspecialchars($ranks['rank_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="education" id="education" required>
                <option value="">-- Choisissez le parcours --</option>

                <?php foreach ($education as $educations): ?>
                    <option value="<?= htmlspecialchars($educations['id']) ?>">
                <?= htmlspecialchars($educations['education_name']) ?>
                    </option>
                <?php endforeach; ?>
                </select>
             </li>
            <li>
            <select name="speciality" id="speciality" required>
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
*/
?>