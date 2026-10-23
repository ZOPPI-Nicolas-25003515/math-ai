<?php

namespace App\Controller;

use App\Service\OpenRouterService;

class AiassistantController
{
    public function mathForm(): void
    {
        \Core\View::show('Aiassistant', [
            'answer' => $answer ?? '',
            'error' => $error ?? '',
            'question' => $question ?? ''
        ]);
    }

    public function mathAction(): void
    {
        $question = trim($_POST['question'] ?? '');
        $answer = null;
        $error = null;

        if ($question === '' || mb_strlen($question) > 2000) {
            $error = 'Saisis une question de 1 à 2000 caractères.';
        } else {
            try {
                $service = new OpenRouterService();
                $answer = $service->ask($question);
            } catch (\Throwable $e) {
                error_log($e->getMessage());
                $error = 'Impossible de contacter MathIA pour le moment.';
            }
        }

        \Core\View::show('Aiassistant', [
            'answer' => $answer,
            'error' => $error,
            'question' => $question ?? ''
        ]);
    }
}
