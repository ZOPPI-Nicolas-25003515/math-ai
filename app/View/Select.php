<?php

namespace App\View;

final class Select extends Component
{
    public function __construct(
        private readonly string $name,
        private readonly string $id,
        private readonly array $content,
    ) {
    }

    public function render(): string
    {
        $name = $this->e($this->name);
        $id = $this->e($this->id);
        $par = $this->renderAll($this->content);

        return
            <<<HTML
                <select name="{$name}" id="{$id}">{$par}</select>
            HTML;
    }
}