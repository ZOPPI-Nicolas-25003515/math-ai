<?php
namespace App\View;

final class Strong extends Component
{
    /**
     * @param array $content
     * @param string $optional
     */
    public function __construct(
        private readonly array $content,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {

        $par = $this->renderAll($this->content);
        $optional = $this->optional;

        return
            <<<HTML
                <strong {$optional}>{$par}</strong>
            HTML
            ;
    }
}