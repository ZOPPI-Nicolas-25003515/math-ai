<?php
namespace App\View;

final class Title extends Component
{
    /**
     * @param int $size
     * @param array $children
     * @param string $class
     */
    public function __construct(
        private int $size,
        private readonly array $children,
        private readonly string $class = '') {
        if (0 >= $size || $size > 6) $this->size = 6;
    }

    public function render(): string
    {
        $class = $this->e($this->class);
        $size = $this->size;
        $par = $this->renderAll($this->children);

        return ($class == '') ?
            <<<HTML
            <h{$size}>
                {$par}
            </h{$size}>
            HTML
            :
            <<<HTML
            <h{$size} class="{$class}">
                {$par}
            </h{$size}>
            HTML;
    }
}