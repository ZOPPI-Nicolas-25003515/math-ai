<?php
namespace App\View;

final class Link extends Component
{
    public function __construct(
        private readonly string $rel,
        private readonly string $href,
        private readonly string $type = '',
        private readonly string $class = ''
    )
    {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $rel = $this->e($this->rel);
        $type = $this->e($this->type);
        $class = $this->e($this->class);
        if ($type === '')
            return ($class == '') ?
                <<<HTML
                <link rel="{$rel}" href= "{$href}">
            HTML
                :
                <<<HTML
                <link rel="{$rel}" href= "{$href}" class= "{$class}">
            HTML;

        else return ($class == '') ?
            <<<HTML
                <link rel="{$rel}" type="{$type}" href= "{$href}">
            HTML
            :
            <<<HTML
                <link rel="{$rel}" type="{$type}" href= "{$href}" class= "{$class}">
            HTML;



    }
}
