<?php

use Libs\Parsedown;

?>

<section class="aiassistant">
    <h1>MathIA</h1>

    <p>Pose ta question à notre Assistant IA </p>

    <form method="POST" action="/aiassistant">
        <label for="question">Version : Chat GPT 4</label>

        <textarea
                id="question"
                name="question"
                rows="5"
                maxlength="2000"
                required
                placeholder="Exemple : Résous 2x + 5 = 15"
        ><?= htmlspecialchars($question ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>

        <button type="submit">Envoyer</button>
    </form>

    <?php

    function markdownAvecMath(string $texte): string
    {
        $formules = [];

        // Extraire \[ ... \] et \( ... \)
        $texte = preg_replace_callback(
                '~\\\\\[.*?\\\\\]|\\\\\(.*?\\\\\)~s',
                function ($m) use (&$formules) {
                    $cle = 'MATHPLACEHOLDER' . count($formules) . 'END';
                    // On échappe le HTML (<, >, &) pour rester en mode sûr
                    $formules[$cle] = htmlspecialchars($m[0], ENT_NOQUOTES, 'UTF-8');
                    return $cle;
                },
                $texte
        );

        $parsedown = new Parsedown();
        $parsedown->setSafeMode(true);
        $html = $parsedown->text($texte);

        // Remettre les formules
        return strtr($html, $formules);
    }

    $htmlOutput = markdownAvecMath($answer ?? '');
    ?>
    <?php if (!empty($answer)): ?>
        <section class="answer">
            <h2>Réponses de MathIA</h2>

            <div class="answer-content">
                <?= $htmlOutput ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
</section>
