<?php
namespace App\View;

/**
 * @param string $href
 * @param array $content
 * @param string $class
 */
final class Hypertext extends Component
{
    public function __construct(
        private readonly string $href,
        private readonly array $content,
        private readonly string $class = ''
    ) {
    }

    public function render(): string
    {
        $href = $this->e($this->href);
        $par = $this->renderAll($this->content);
        $class = $this->e($this->class);

        return ($class == '') ?
            <<<HTML
                <a href="{$href}">{$par}</a>
            HTML
            :
            <<<HTML
                <a href="{$href}" class="{$class}">{$par}</a>
            HTML
            ;
    }
}