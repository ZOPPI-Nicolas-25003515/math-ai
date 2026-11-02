<?php

namespace App\Service;

use RuntimeException;

class OpenRouterService

{

    private function corrigerLatex(string $texte): string
    {
        // 1. Protéger les formules déjà correctement délimitées
        $protegees = [];
        $texte = preg_replace_callback(
            '~(\\\\\[.*?\\\\\]|\\\\\(.*?\\\\\)|\$\$.*?\$\$)~s',
            function ($m) use (&$protegees) {
                $cle = '@@MATH' . count($protegees) . '@@';
                $protegees[$cle] = $m[0];
                return $cle;
            },
            $texte
        );

        // 2. Blocs [ ... ] contenant une commande LaTeX (ligne seule)
        $texte = preg_replace_callback(
            '~^\s*\[\s*(.*?\\\\[a-zA-Z]+.*?)\s*\]\s*$~ms',
            fn ($m) => '\\[' . trim($m[1]) . '\\]',
            $texte
        );

        // 3. Parenthèses contenant une commande LaTeX (gère 1 niveau d'imbrication)
        $texte = preg_replace_callback(
            '~\(\s*((?:[^()]|\([^()]*\))*?\\\\[a-zA-Z]+(?:[^()]|\([^()]*\))*?)\s*\)~',
            fn ($m) => '\\(' . trim($m[1]) . '\\)',
            $texte
        );

        // 4. Restaurer les formules protégées
        return strtr($texte, $protegees);
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
Tu es MathIA, une IA qui aide les lyceens

FORMAT OBLIGATOIRE :

- Toute formule mathématique doit utiliser MathJax 3.
- Formules dans le texte : \( ... \).
- Formules centrées : \[ ... \].
- Fractions : \( \frac{a}{b} \).
- Racines : \( \sqrt{x} \).
- Puissances : \( x^{2} \).
- Utilise de manière pertinente les balises Markdown

INTERDICTIONS ABSOLUES :

- Ne jamais écrire ( \frac{a}{b} ).
- Ne jamais écrire [ \frac{a}{b} ].
- Ne jamais au grand jamais mettre ::mark car c'est moche.

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

