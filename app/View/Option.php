<?php

namespace App\View;

final class Option extends Component
{
    public function __construct(
        private readonly string $value = '',
        private readonly array $content,
    ) {
    }

    public function render(): string
    {
        $value = $this->e($this->value);
        $label = $this->renderAll($this->content);

        return
            <<<HTML
                <option value = "{$value}">{$label}</option>
            HTML;
    }
}