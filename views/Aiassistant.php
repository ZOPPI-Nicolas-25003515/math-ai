<?php
use App\Tags\{Alert,Textarea,Button,Strong,Form,Input,Label,Layout,Link,Hypertext,Paragraph,Title,Container,RawHtml};
use App\Libs\Parsedown;
function markdownWithMaths(string $text): string
{
    $formula = [];

    // Extraire \[ ... \] et \( ... \)
    $text = preg_replace_callback(
        '~\\\\\[.*?\\\\\]|\\\\\(.*?\\\\\)~s',
        function ($m) use (&$formula) {
            $cle = 'MATHPLACEHOLDER' . count($formula) . 'END';
            // On échappe le HTML (<, >, &) pour rester en mode sûr
            $formula[$cle] = htmlspecialchars($m[0], ENT_NOQUOTES, 'UTF-8');
            return $cle;
        },
        $text
    );

    $parsedown = new Parsedown();
    $parsedown->setSafeMode(true);
    $html = $parsedown->text($text);

    // Remettre les formules
    return strtr($html, $formula);
}

/**
 * @var array<string> $errors
 */
echo new Layout (
        'Assistant IA',isset($loggedUser),[
                new Container('section',[
                        new Title(1,['MathAI']),
                    new Paragraph(['Pose ta question à la LLM']),
                    new Form ('/aiassistant','post',[
                            new Label('question','question',['Version : Chat GPT 4']),
                        new Textarea('question','question',5,2000,'Exemple : Résous 2x + 5 = 15','required',[htmlspecialchars($question ?? '', ENT_QUOTES, 'UTF-8')]),
                        new Button('submit','',['Envoyer'])
                    ]),
                    !empty($answer) ? new Container('section',[
                        new Title(2,['Réponse de l\'IA']),
                        new Container('div',[new RawHtml(markdownWithMaths($answer))],'class=answer-content')
                    ],'class=answer') : new Paragraph([new Alert ($errors)],'class=error')
                ],'class=aiassistant')
        ]
);