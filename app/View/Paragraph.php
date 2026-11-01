<?php
namespace App\View;

final class Paragraph extends Component
{
    /**
     * @param array $children
     * @param string $class
     */
    public function __construct(
        private readonly array  $children,
        private readonly string $class = '') {
    }

    public function render(): string
    {
        $class = $this->e($this->class);
        $par = $this->renderAll($this->children);

        return ($class == '') ?
            <<<HTML
            <p>
                {$par}
            </p>
            HTML
            :
            <<<HTML
            <p class="{$class}">
                {$par}
            </p>
            HTML;
    }
}