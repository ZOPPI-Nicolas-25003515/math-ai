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
        $for = $this->e($this->for);
        $id = $this->e($this->id);
        $label = $this->renderAll($this->label);
        $optional = $this->e($this->optional);

        return
            <<<HTML
                <label id="{$id}" for="{$for}" {$optional}>{$label}</label>
            HTML;
    }
}