<?php
?>
<span>
    <a href="/analyseia">Retour</a>
    <form action="/addexercise" method="post">
    <ul>
        <li>
            <p>
                <label for="email">rentré l'enoncer</label>
                <input type="email" name="email" value="" required>
            </p>
        </li>
        <li>
            <p>
                <label for="genre-select">choisiser le genre:</label>

                <select name="genre" id="genre-select">
                    <option value="reponse libre">reponse libre</option>
                    <option value="QCM a une reponse">QCM a une reponse</option>
                    <option value="QCM a choix multiple">QCM a choix multiple</option>
                </select>
            </p>
        </li>
        <li>
            <p>
                <label for="dificulte-select">choisiser la dificulter:</label>

                <select name="dificulte" id="dificulte-select">
                    <option value="moyen">moyen</option>
                    <option value="facile">facile</option>
                    <option value="dificile">dificile</option>
                </select>
            </p>
        </li>
        <button type="submit">Ajouter</button>
    </ul>
    </form>
</span>