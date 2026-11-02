<?php
$type = $A_view['type'] ?? [];
?>

<?php
if($type == "reponse libre"){?>
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
    <?php
}
elseif($type == "QCM a une reponse"){?>
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
<?php
}
elseif($type == "QCM a choix multiple"){?>
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
<?php
}
elseif($type == ''){?>
    <p>
        <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises</b></label><br>
    </p>
    <?php
}
else{
?>
    <p>
        <label><b>le fichier doit avoir un colone nommer 'reponse' et une autre nommer 'statut' avec un TRUE pour les bonne reponse est un FALSE pour les mauvaises</b></label><br>
    </p>

    <?php
}
?>