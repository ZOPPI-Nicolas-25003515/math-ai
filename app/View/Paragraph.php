<?php
namespace App\View;

final class Paragraph extends Component
{
    /** @param array<string> $texts */
    public function __construct(
        private readonly array $texts
    ) {
    }

    public function render(): string
    {
        $par = '';
        foreach ($this->texts as $text) {
            $par .= $text instanceof Component ? $text->render() : $text;
            $par .= ' ';
        }

        return <<<HTML
            <p>
                {$par}
            </p>

            HTML;
    }
}