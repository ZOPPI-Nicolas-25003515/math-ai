<?php
namespace App\View;

final class Textarea extends Component
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly int $rows,
        private readonly int $maxlength, //required
        private readonly string $placeholder,
        private readonly string $optional = '',
    ) {
    }

    public function render(): string
    {
        $id = $this->e($this->id);
        $optional = $this->e($this->optional);
        $maxlength = $this->maxlength;
        $rows = $this->rows;
        $placeholder = $this->e($this->placeholder);
        $name = $this->e($this->name);

        return
            <<<HTML
                <textarea id={$id}
            name="{$name}"
            rows="{$rows}" maxlength="{$maxlength}" required placeholder="{$placeholder}" {$optional}></textarea>
            HTML;
    }
}