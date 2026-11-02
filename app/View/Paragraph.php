<?php
namespace App\View;

final class Paragraph extends Component
{
    /**
     * @param array $children
     * @param string $optional
     */
    public function __construct(
        private readonly array  $children,
        private readonly string $optional = '') {
    }

    public function render(): string
    {
        $optional = $this->e($this->optional);
        $par = $this->renderAll($this->children);

        return
            <<<HTML
            <p {$optional}>
                {$par}
            </p>
            HTML;
    }
}