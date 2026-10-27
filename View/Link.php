<?php
namespace View;

final class Link extends Component
{
    public function __construct(
        private readonly string $href,
        private readonly string $par,
    ) {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $par = $this->e($this->par);

        return <<<HTML
                <a href="{$href}">{$par}</a>
            HTML;
    }
}