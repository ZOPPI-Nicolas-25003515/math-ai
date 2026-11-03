<?php
namespace App\View;

final class Button extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $optional = '',
        private readonly string $par = '',
    ) {
    }

    public function render(): string
    {
        $optional = $this->e($this->optional);
        $type = $this->e($this->type);
        $par = $this->e($this->par);

        return
            <<<HTML
                <button type="{$type}" {$optional}>{$par}</button>
            HTML;
    }
}