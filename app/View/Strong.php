<?php
namespace App\View;

final class Strong extends Component
{
    public function __construct(
        private readonly string $text,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {

        $text = $this->e($this->text);
        $optional = $this->e($this->optional);

        return
            <<<HTML
                <strong {$optional}>{$text}</strong>
            HTML
            ;
    }
}