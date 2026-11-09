<?php

use App\View\{Alert,Button,Form,Input,Layout,Label,Hypertext,Paragraph,Title,Container,Select,Option};
use App\Model\UserRepository;

$A_view = $A_view ?? [];
$errors = $A_view['errors'] ?? [];
$userRepository = new UserRepository();
$subject = $userRepository->takeSubject();
$option = [];

foreach ($subject as $subjec) {
    $option = new Option(htmlspecialchars($subjec['id']),[htmlspecialchars($subjec['subject_name'])] );
}
echo new Layout('Ajout de cours',isset($loggedUser),[
                new Title (1,['Ajout de cours']),
                new Paragraph(
                        [new Alert ($errors)]),
                new Container('span',
                        [new Hypertext('/home',['Retour']),new Form("/addclass" ,"POST" ,
                                [new Container('ul',
                                        [new Container('li',
                                                [new Paragraph(
                                                        [new Label('pdf_file', 'pdf_file', [new Container('b',['Étape 1 : Choisir le cours en PDF :'])
                                                        ]), new Input('file','pdf_file','pdf_file','accept=".pdf, application/pdf" required')

                                                        ]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Label('titre_cours', 'titre_cours', [new Container('b',['Étape 2 : Titre du cours :'])
                                                        ]), new Input('text','titre_cours','titre_cours','required')

                                                        ]
                                                )]
                                        ),new Container('li',
                                                [new Paragraph(
                                                        [new Select('subject','subject',[$option])]
                                                )]
                                        ),new Button('submit','',['Finaliser et Importer'])]
                                )]
                        )],"multipart/form-data")
            ,]
);

/*

<h1>Ajout de cours</h1>


<span>
    <a href="/home">Retour</a>
    <form action="/addclass" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label for="pdf_file"><b>Étape 1 : Choisir le cours en PDF :</b></label><br>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf, application/pdf" required>
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
*/
?>

