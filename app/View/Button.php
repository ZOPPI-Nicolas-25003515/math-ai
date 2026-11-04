<?php
namespace App\View;

final class Button extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $optional = '',
        private readonly array $par = [],
    ) {
    }

    public function render(): string
    {
        $optional = $this->optional;
        $type = $this->e($this->type);
        $par = $this->renderAll($this->par);

        return
            <<<HTML
                <button type="{$type}" {$optional}>{$par}</button>
            HTML;
    }
}