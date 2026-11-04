<?php
namespace App\View;

/**
 * @param string $href
 * @param array $content
 * @param string $optional
 */
final class Hypertext extends Component
{
    public function __construct(
        private readonly string $href,
        private readonly array $content,
        private readonly string $optional = ''
    ) {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $par = $this->renderAll($this->content);
        $optional = $this->optional;

        return
            <<<HTML
                <a href="{$href}" {$optional}>{$par}</a>
            HTML
            ;
    }
}