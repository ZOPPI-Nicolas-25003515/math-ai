
<?php

class OpenRouterService
{
    public function ask(string $question): string
    {
        $apiKey = getenv('OPENROUTER_API_KEY');

        if (!$apiKey) {
            throw new RuntimeException(
                'Clé API OpenRouter manquante.'
            );
        }

        $data = [
            // Choix d' identifiant disponible dans le catalogue OpenRouter.
            'model' => 'openai/gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' =>
                        'Tu es MathIA, un assistant pédagogique ' .
                        'spécialisé en mathématiques. ' 
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ],
            'temperature' => 0.3,
            'max_tokens' => 1200
        ];

        $curl = curl_init(
            'https://openrouter.ai/api/v1/chat/completions'
        );

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json',
                'X-OpenRouter-Title: MathIA'
            ],
            CURLOPT_POSTFIELDS => json_encode(
                $data,
                JSON_UNESCAPED_UNICODE
            )
        ]);

        $response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        if ($response === false) {
            throw new RuntimeException(
                'Erreur de connexion : ' . $error
            );
        }

        $result = json_decode($response, true);

        if ($status < 200 || $status >= 300) {
            error_log('OpenRouter HTTP ' . $status . ': ' . $response);

            throw new RuntimeException(
                'Le service IA a retourné une erreur.'
            );
        }

        $answer = $result['choices'][0]['message']['content']
            ?? null;

        if (!is_string($answer) || $answer === '') {
            throw new RuntimeException(
                'La réponse de MathIA est vide.'
            );
        }

        return $answer;
    }
}
