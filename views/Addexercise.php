<?php

use App\View\{Alert, Button, Form, Input, Layout, Label, Link, Hypertext, Paragraph, Title, Container, Select, Option};
use App\Model\UserRepository;

$A_view = $A_view ?? [];
$errors = $A_view['errors'] ?? [];
$userRepository = new UserRepository();
$subject = $userRepository->takeSubject();
$option = [];

foreach ($subject as $subjec) {
    $option = new Option(htmlspecialchars($subjec['id']), [htmlspecialchars($subjec['subject_name'])]);
}
echo new Layout('Ajout d exercice', isset($loggedUser), [
                new Title (1, ['Ajout d exercice']),
                new Paragraph(
                        [new Alert ($errors)]),
                new Container('span',
                        [new Hypertext('/home', ['Retour']), new Form("/addexercise", "POST",
                                [new Container('ul',
                                        [new Container('li',
                                                [new Paragraph(
                                                        [new Label('pdf_file', 'pdf_file', [new Container('b', ['Choisiser l exercice en PDF :'])
                                                        ]), new Input('file', 'pdf_file', 'pdf_file', 'accept=".pdf, application/pdf" required')

                                                        ]
                                                )]
                                        ), new Container('li',
                                                [new Paragraph(
                                                        [new Select('subject', 'subject',
                                                                [new Option('', ['-- Choisissez un sujet d exercice --']),$option]
                                                )]
                                        ), new Container('li',
                                                [new Paragraph(
                                                        [new Select('type', 'subject', [new Option('', ['-- Choisissez le type d exercice --']
                                                        ), new Option('reponse libre', ['reponse libre']
                                                        ),new Option('QCM a une reponse',['QCM a une reponse']
                                                        ),new Option('CM a choix multiple',['CM a choix multiple'])])]
                                                )]
                                        ), new Container('li',
                                                [new Paragraph(
                                                        [new Select('difficulty', 'subject', [new Option('', ['-- Choisisser la dificulter --']
                                                        ),new Option('facile', ['facile']
                                                        ),new Option('moyen',['moyen']
                                                        ),new Option('dificile',['dificile'])])]
                                                )]
                                        ), new Button('submit', '', ['Ajouter'])]
                                )]
                        )], "multipart/form-data")
            ,])
]);
/*

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
*/
?>