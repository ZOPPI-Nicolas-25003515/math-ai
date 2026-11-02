<?php

namespace App\Service;

use RuntimeException;

class OpenRouterService

{

    private function corrigerLatex(string $texte): string
    {
        // Commandes LaTeX reconnues
        $commandes = 'frac|sqrt|times|div|approx|pi|alpha|beta|theta|'
            . 'sum|int|infty|mathbb|log|sin|cos|tan';

        // Expressions entre parenthèses simples
        $texte = preg_replace_callback(
            '~(?<!\\\\)\(\s*((?:\\\\(?:' . $commandes . ')\b)[^()]*)\s*\)~',
            function ($m) {
                return '\\(' . trim($m[1]) . '\\)';
            },
            $texte
        );

        // Expressions entre crochets simples
        $texte = preg_replace_callback(
            '~(?<!\\\\)\[\s*((?:\\\\(?:' . $commandes . ')\b)[^\[\]]*)\s*\]~',
            function ($m) {
                return '\\[' . trim($m[1]) . '\\]';
            },
            $texte
        );

        return $texte;
    }

    public function ask(string $question): string
    {
        $apiKey = getenv('OPENROUTER_API_KEY');

        if (!$apiKey) {
            throw new RuntimeException(
                'Clé API OpenRouter manquante.'
            );
        }



        $data = [
            'model' => 'openai/gpt-4o-mini',

            'messages' => [
                [
                    'role' => 'system',
                    'content' => <<<'PROMPT'
Tu es MathIA, un professeur de mathématiques.

FORMAT OBLIGATOIRE :

- Toute formule mathématique doit utiliser MathJax 3.
- Formules dans le texte : \( ... \).
- Formules centrées : \[ ... \].
- Fractions : \( \frac{a}{b} \).
- Racines : \( \sqrt{x} \).
- Puissances : \( x^{2} \).

INTERDICTIONS ABSOLUES :

- Ne jamais écrire ( \frac{a}{b} ).
- Ne jamais écrire [ \frac{a}{b} ].
- Ne jamais écrire une formule mathématique sans délimiteurs.
- Ne jamais utiliser de blocs de code pour les formules.

Vérifie le formatage de chaque formule avant de répondre.
PROMPT
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ],

            'temperature' => 0.1,
            'max_tokens' => 2000
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

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new RuntimeException(
                'Erreur JSON : ' . json_last_error_msg()
            );
        }

        if ($status < 200 || $status >= 300) {
            error_log('OpenRouter HTTP ' . $status . ': ' . $response);

            throw new RuntimeException(
                'Le service IA a retourné une erreur.'
            );
        }


        // Récupération de la réponse
        $answer = $result['choices'][0]['message']['content'] ?? null;

        if (!is_string($answer) || trim($answer) === '') {
            error_log('Réponse OpenRouter : ' . $response);

            throw new RuntimeException(
                'La réponse de MathIA est vide.'
            );
        }

        // Correction automatique du LaTeX
        $answer = $this->corrigerLatex($answer);

        return $answer;
    }
}

