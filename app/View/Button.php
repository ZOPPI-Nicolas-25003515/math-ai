<?php
namespace App\View;

final class Button extends Component
{
    public function __construct(
        private readonly string $type,
        private readonly string $par = '',
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $type = $this->e($this->type);
        $class = $this->e($this->class);
        $par = $this->e($this->par);

        return ($class == '') ?
            <<<HTML
                <button type="{$type}">{$par}</button>
            HTML
            :
            <<<HTML
                <button type="{$type}" class="{$class}">{$par}</button>
            HTML;
    }
}