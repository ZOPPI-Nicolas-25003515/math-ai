<?php
namespace View;
final class Strong extends Component
{
    public function __construct(
        private readonly string $text,
    ) {
    }

    public function render(): string
    {

        $text = $this->e($this->text);

        return <<<HTML
                <strong>{$text}</strong>
            HTML;
    }
}