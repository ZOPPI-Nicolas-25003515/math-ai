<section class="assistantia">
    <h1>MathIA</h1>

    <p>Pose ta question à notre Assistant IA </p>

    <form method="POST" action="/assistantia">
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

    <?php if (!empty($answer)): ?>
        <section class="answer">
            <h2>Réponses de MathIA</h2>
            <p><?= nl2br(htmlspecialchars($answer, ENT_QUOTES, 'UTF-8')) ?></p>
        </section>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>
</section>