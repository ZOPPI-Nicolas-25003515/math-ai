<?php

namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Service\OpenRouterService;

class AiassistantController
{
    public function aiassistantForm(): void
    {
        \Core\View::show('Aiassistant', [
            'answer' => $answer ?? '',
            'error' => $error ?? '',
            'question' => $question ?? ''
        ]);
    }

    public function aiassistantAction(): void
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

        View::show('assistantia', [
            'answer' => $answer,
            'error' => $error,
            'question' => $question ?? ''
        ]);
    }
}
