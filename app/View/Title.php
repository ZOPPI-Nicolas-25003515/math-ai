<?php
namespace App\View;

final class Title extends Component
{
    /**
     * @param int $size
     * @param array $children
     * @param string $optional
     */
    public function __construct(
        private int $size, //h1,h2,h3...
        private readonly array $children,
        private readonly string $optional = '') {
        if (0 >= $size || $size > 6) $this->size = 6;
    }

    public function render(): string
    {
        $optional = $this->optional;
        $size = $this->size;
        $par = $this->renderAll($this->children);

        return
            <<<HTML
            <h{$size} {$optional}>
                {$par}
            </h{$size}>
            HTML;
    }
}