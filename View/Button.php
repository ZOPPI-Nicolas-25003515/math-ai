<?php
namespace View;
final class Button extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $par = '',
    ) {
    }

    public function render(): string
    {
        $type = $this->e($this->type);
        $par = $this->e($this->par);

        return <<<HTML
                <button type="{$type}">{$par}</button>
            HTML;
    }
}