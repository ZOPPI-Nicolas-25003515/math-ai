<?php
namespace App\View;

final class Button extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $optional = '',
        private readonly string $par = '',
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $optional = $this->e($this->optional);
        $type = $this->e($this->type);
        $class = $this->e($this->class);
        $par = $this->e($this->par);

        return ($class == '') ?
            <<<HTML
                <button type="{$type}" {$optional}>{$par}</button>
            HTML
            :
            <<<HTML
                <button type="{$type}" {$optional} class="{$class}">{$par}</button>
            HTML;
    }
}