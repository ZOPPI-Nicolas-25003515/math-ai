<?php

namespace App\Controller;
use App\Core\{View,Request,Response};
use App\Service\OpenRouterService;

class AiassistantController
{
    private View $view;
    public function __construct(View $view) {
        $this->view = $view;
    }
    public function aiassistantForm(): Response
    {
        return $this->view->render('Aiassistant', array( 'answer' => '',
                'errors' => [],
                'question' => '',
            'formData' => [])
        );
    }

    public function aiassistantAction(Request $request): Response
    {
        $question = trim($request->post('question') ?? '');
        $answer = '';
        $errors = [];

        if ($question === '' || mb_strlen($question) > 2000) {
            $errors[] = 'Saisis une question de 1 à 2000 caractères.';
        } else {
            try {
                $service = new OpenRouterService();
                $answer = $service->ask($question);
            } catch (\Throwable $e) {
                error_log($e->getMessage());
                $errors[] = 'Impossible de contacter MathIA pour le moment.';
            }
        }

        return $this->view->render('Aiassistant', [
            'answer' => $answer,
            'errors' => $errors,
            'question' => $question,
            'formData' => $request->post

        ]);
    }
}
