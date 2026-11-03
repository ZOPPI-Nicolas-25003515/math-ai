<?php
namespace App\View;

final class Input extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $id,
        private readonly string $name,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {
        $name = $this->e($this->name);
        $id = $this->e($this->id);
        $type = $this->e($this->type);
        $optional = $this->e($this->optional);

        return
            <<<HTML
                <input type="{$type}" id="{$name}" name="{$name}" {$optional}" required>
            HTML;
    }
}