<?php
namespace App\View;

final class Link extends Component
{
    public function __construct(
        private readonly string $rel,
        private readonly string $href,
        private readonly string $optional = ''
    )
    {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $rel = $this->e($this->rel);
        $optional = $this->optional;
        return
            <<<HTML
                <link rel="{$rel}" href= "{$href}" {$optional}>
            HTML;



    }
}
