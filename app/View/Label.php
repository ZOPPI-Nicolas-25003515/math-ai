<?php
namespace App\View;

final class Label extends Component
{
    public function __construct(
        private readonly string $for,
        private readonly string $id,
        private readonly array $label,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {
        $for = $this->for;
        $id = $this->id;
        $label = $this->renderAll($this->label);
        $optional = $this->optional;

        return
            <<<HTML
                <label id="{$id}" for="{$for}" {$optional}>{$label}</label>
            HTML;
    }
}