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
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $id = $this->e($this->id);
        $class = $this->e($this->class);
        $maxlength = $this->maxlength;
        $rows = $this->rows;
        $placeholder = $this->e($this->placeholder);
        $name = $this->e($this->name);

        return ($class == '') ?
            <<<HTML
                <textarea id={$id}
            name="{$name}"
            rows="{$rows}" maxlength="{$maxlength}" required placeholder="{$placeholder}"></textarea>
            HTML
            :
            <<<HTML
                <textarea id={$id}
            name="{$name}"
            rows="{$rows}" maxlength="{$maxlength}" required placeholder="{$placeholder}" class = "{$class}"></textarea>
            HTML;
    }
}