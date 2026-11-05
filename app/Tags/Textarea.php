<?php
namespace App\Tags;

final class Textarea extends Component
{
    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly int $rows,
        private readonly int $maxlength, //required
        private readonly string $placeholder,
        private readonly string $optional = '',
        private readonly array $content = [],
    ) {
    }

    public function render(): string
    {
        $id = $this->e($this->id);
        $optional = $this->optional;
        $maxlength = $this->maxlength;
        $rows = $this->rows;
        $placeholder = $this->e($this->placeholder);
        $name = $this->e($this->name);
        $content = $this->renderAll($this->content);

        return
            <<<HTML
                <textarea id={$id}
            name="{$name}"
            rows="{$rows}" maxlength="{$maxlength}" placeholder="{$placeholder}" {$optional}>{$content}</textarea>
            HTML;
    }
}