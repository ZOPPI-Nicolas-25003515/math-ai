async function afficherReponse(texte) {
    const element = document.getElementById("reponse");

    // Insérer d'abord le contenu
    element.textContent = texte;

    // Puis demander à MathJax de le traiter
    await MathJax.typesetPromise([element]);
}

