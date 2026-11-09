<?php
use App\View\{Button,Form,Input,Layout,Label,Paragraph,Container};
$type = $A_view['type'] ?? [];

if($type == "reponse libre"){

    echo new Layout('Ajout reponse exercice',isset($loggedUser),[
                    new Container('span',
                            [new Form("/answerexercise" ,"POST" ,
                                    [new Container('ul',
                                            [new Container('li',
                                                    [new Paragraph(
                                                            [new Label('answer', 'answer', [new Container('b',['ecrit la bonne réponse'])
                                                            ]), new Input('answer','answer','answer','required')

                                                            ]
                                                    )]
                                            ),new Button('answer','',['Finaliser'])]
                                    )]
                            )],"multipart/form-data")
                ,]
    );
}
elseif($type == "QCM a une reponse"){
    echo new Layout('Ajout reponse exercice',isset($loggedUser),[
                    new Container('span',
                            [new Form("/answerexercise" ,"POST" ,
                                    [new Container('ul',
                                            [new Container('li',
                                                    [new Paragraph(
                                                            [new Label('answer', 'answer', [new Container('b',["le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour la bonne reponse est un FALSE pour les mauvaises"])
                                                            ])]
                                                    )]
                                            ),[new Container('li',
                                                    [new Paragraph(
                                                            [new Label('csv_file', 'csv_file', [new Container('b',["choisisser le fichier contenant les reponse(en csv):"])
                                                            ]), new Input('file','csv_file','csv_file','accept=".csv, text/csv" required')

                                                            ]
                                                    )]
                                            ),new Button('answer','',['Finaliser'])]]
                                    )]
                            )],"multipart/form-data")
                ,]
    );
}
elseif($type == "QCM a choix multiple"){
    echo new Layout('Ajout reponse exercice',isset($loggedUser),[
                    new Container('span',
                            [new Form("/answerexercise" ,"POST" ,
                                    [new Container('ul',
                                            [new Container('li',
                                                    [new Paragraph(
                                                            [new Label('answer', 'answer', [new Container('b',["le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises"])
                                                            ])]
                                                    )]
                                            ),[new Container('li',
                                                    [new Paragraph(
                                                            [new Label('csv_file', 'csv_file', [new Container('b',["choisisser le fichier contenant les reponse(en csv):"])
                                                            ]), new Input('file','csv_file','csv_file','accept=".csv, text/csv" required')

                                                            ]
                                                    )]
                                            ),new Button('answer','',['Finaliser'])]]
                                    )]
                            )],"multipart/form-data")
                ,]
    );
}
elseif($type == ''){
    echo new Layout('Ajout reponse exercice',isset($loggedUser),
            [new Paragraph(
                    [new Container('b',['test1'])])]);
}
else{
    echo new Layout('Ajout reponse exercice',isset($loggedUser),
            [new Paragraph(
                    [new Container('b',['test2'])])]);
}
    /*
    <span>
<form action="/answerexercise" method="POST" enctype="multipart/form-data">
    <ul>
        <li>
            <p>
                <label for="answer"><b>ecrit la bonne réponse</b></label><br>
                <input type="answer" name="answer" value="" required>
            </p>
        </li>
        <button type="submit" name="submit_import">Finaliser</button>
    </ul>
</form>
</span>
    <?php
}
elseif($type == "QCM a une reponse"){?>
<span>
<form action="/answerexercise" method="POST" enctype="multipart/form-data">
    <ul>
        <li>
            <p>
                <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour la bonne reponse est un FALSE pour les mauvaises</b></label><br>
            </p>
        </li>
        <li>
            <p>
                <label for="csv_file"><b>choisisser le fichier contenant les reponse(en csv):</b></label><br>
                <input type="file" name="csv_file" id="csv_file" accept=".csv, text/csv" required>
            </p>
        </li>
        <button type="submit" name="submit_import">Finaliser</button>
    </ul>
</form>
</span>
<?php
}
elseif($type == "QCM a choix multiple"){?>
    <span>
    <form action="/answerexercise" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <p>
                    <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises</b></label><br>
                </p>
            </li>
                <p>
                    <label for="csv_file"><b>choisisser le fichier contenant les reponse(en csv):</b></label><br>
                    <input type="file" name="csv_file" id="csv_file" accept=".csv, text/csv" required>
                </p>
            </li>
            <button type="submit" name="submit_import">Finaliser</button>
        </ul>
    </form>
    </span>
<?php
}
elseif($type == ''){?>
<span>
    <p>
        <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises</b></label><br>
    </p>
    </span>
    <?php
}
else{
?>
    <span>
    <p>
        <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises</b></label><br>
    </p>
</span>
    <?php
}*/
?>