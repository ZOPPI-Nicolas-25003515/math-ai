<?php
namespace App\View;

final class Container extends Component
{
    /**
     * @param string $type
     * @param array $content
     * @param string $class
     */
    public function __construct(
        private readonly string $type,private readonly array $content,private readonly string $class = '') {
    }

    public function render(): string
    {
        $type = $this->e($this->type);
        $class = $this->e($this->class);
        $par = $this->renderAll($this->content);

        return ($class == '') ?
            <<<HTML
            <{$type}>
                {$par}
            </{$type}>
            HTML
            :
            <<<HTML
            <{$type} class="{$class}">
                {$par}
            </{$type}>
            HTML;
    }
}