async function afficherReponse(texte) {
    const element = document.getElementById("reponse");

    await MathJax.typesetClear([element]);

    element.innerHTML = reponse;

    await MathJax.typesetPromise([element]);
}

