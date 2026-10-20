
<section class="assistantia">
    <h1>MathIA</h1>

    <p>Pose ta question </p>

    <form method="POST" action="index.php?url=assistantia">
        <label for="question">Ta question</label>

        <textarea
            id="question"
            name="question"
            rows="5"
            maxlength="2000"
            required
            placeholder="Exemple : Résous 2x + 5 = 15"
        ></textarea>

        <button type="submit">Envoyer</button>
    </form>

    <?php if (isset($A_vue['answer'])): ?>
        <section class="answer">
            <h2>Réponse de MathIA</h2>

            <p><?= nl2br(htmlspecialchars(
                $A_vue['answer'],
                ENT_QUOTES,
                'UTF-8'
            )) ?></p>
        </section>
    <?php endif; ?>

    <?php if (isset($A_vue['error'])): ?>
        <p class="error">
            <?= htmlspecialchars(
                $A_vue['error'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    <?php endif; ?>
</section>
